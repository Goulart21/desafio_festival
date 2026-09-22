

<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/atividades.php';

class Atividadeservice
{

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function cadastrarAtividade(Atividades $atividades): string
    {

        $sql = "INSERT INTO atividades
        (nome_atividade, descricao, data_atividade, hora_inicio, hora_fim, local_atividade, capacidade)
        VALUES
        (:nome_atividade, :descricao, :data_atividade, :hora_inicio, :hora_fim, :local_atividade, :capacidade)";

        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute([
            ':nome_atividade' => $atividades->getNomeAtividade(),
            ':descricao' => $atividades->getDescricao(),
            ':data_atividade' => $atividades->getDataAtividade(),
            ':hora_inicio' => $atividades->getHoraInicio(),
            ':hora_fim' => $atividades->getHoraFim(),
            ':local_atividade' => $atividades->getLocalAtividade(),
            ':capacidade' => $atividades->getCapacidade()
        ])) {
            return 'SUCESSO';
        }
        return 'ERRO';
    }

    public function listarAtividade(): array
    {

        $sql = "SELECT * FROM atividades ORDER BY nome_atividade";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id_atividade): ?array
    {

        $sql = "SELECT * FROM atividades WHERE id_atividade = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id_atividade
        ]);

        $atividades = $stmt->fetch(PDO::FETCH_ASSOC);

        return $atividades ?: null;
    }

    public function atualizarAtividade(int $id_atividade, Atividades $atividades): string
    {

        $sql = "UPDATE atividades
        SET nome_atividade = :nome_atividade,
        descricao = :descricao,
        data_atividade = :data_atividade,
        hora_inicio = :hora_inicio,
        hora_fim = :hora_fim,
        local_atividade = :local_atividade,
        capacidade = :capacidade,
        WHERE id_atividade = :id";

        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute([
            ':nome_atividade' => $atividades->getNomeAtividade(),
            ':descricao' => $atividades->getDescricao(),
            ':data_atividade' => $atividades->getDataAtividade(),
            ':hora_inicio' => $atividades->getHoraInicio(),
            'hora_fim' => $atividades->getHoraFim(),
            'local_atividade' => $atividades->getLocalAtividade(),
            ':capacidade' => $atividades->getCapacidade(),
            ':id' => $id_atividade
        ])) {

            return 'ATUALIZADO';
        }

        return 'ERRO';
    }

    public function excluir(int $id_atividade): string
    {

        $sql = "SELECT COUNT(*)
    FROM inscricoes
    WHERE id_atividade = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'id:' => $id_atividade
        ]);

        $quantidade = $stmt->fetchColumn();

        if ($quantidade > 0) {
            return 'POSSUI_INSCRICOES';
        }

        $sql = "DELETE FROM atividaes
        WHERE  id_atividade = :id";

        $stmt = $this->pdo->prepare($sql);

        if($stmt->execute([
            ':id' => $id_atividade
        ])){
            return 'EXCLUIDO';
        }

        return 'ERRO';
    }
}


?>