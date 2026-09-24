

<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/inscricoes.php';

class InscricaoService{

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function cadastrarInscricao(Inscricoes $inscricao): string{

        $sql = "SELECT COUNT(*)
        FROM inscricoes
        WHERE id_participante = :id_participante
        AND id_atividade = :id_atividade
        AND status = 'ATIVA'";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id_participante' => $inscricao->getIdParticipante(),
            ':id_atividade' => $inscricao->getIdAtividade()
        ]);

        if($stmt->fetchColumn() > 0){
            return 'DUPLICADA';
        }

        $sql = "SELECT capacidade
        FROM atividades
        WHERE id_atividade = :id_atividade";

        $stmt->execute([
            ':id_atividade' => $inscricao->getIdAtividade()
        ]);

        $capacidade = $stmt->fetchColumn();

        if($capacidade === false){

            return 'ATIVIDADE_NAO_ENCONTRADA';
        }

        $sql = "SELECT COUNT(*)
        FROM inscricoes
        WHERE id_atividade = :id_atividade
        AND status = 'ATIVA'";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id_atividade' => $inscricao->getIdAtividade()
        ]);

        $quantidadeInscritos = $stmt->fetchColumn();

        if($quantidadeInscritos >= $capacidade){
            return 'LOTADA';
        }

        $sql = "INSERT INTO inscricoes
        (id_participante, id_atividade)
        VALUES  
        (:id_participante, :id_atividade)";

        if($stmt->execute([
            ':id_participante' => $inscricao->getIdParticipante(),
            ':id_atividade' => $inscricao->getIdAtividade()
        ])) {
            return 'SUCESSO';
        }

        return 'ERRO';

    }
}


?>