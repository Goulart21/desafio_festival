

<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/participantes.php';

class ParticipanteService
{

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function cadastrar(Participantes $participante): string
    {

        $sql = "SELECT COUNT(*)
    FROM participantes WHERE email = :email";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':email' => $participante->getEmail()
        ]);

        if ($stmt->execute([
            ':nome' => $participante->getNomeParticipante(),
            ':email' => $participante->getEmail(),
            ':telefone' => $participante->getTelefone()
        ])) {
            return 'SUCESSO';
        }
        return 'ERRO';
    }

    public function listar(): array
    {

        $sql = "SELECT * FROM participantes ORDER BY nome";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): array
    {

        $sql = "SELECT * FROM participantes WHERE id_participante = :id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        $participante  = $stmt->fetch(PDO::FETCH_ASSOC);
        return $participante ?: null;
    }

    public function atualizar(
        int $id_participante,
        Participantes $participante
    ): bool {

        $sql = "UPDATE participantes
        SET nome = :nome,
        email = :email,
        telefone :telefone,
        WHERE id_participante = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nome' => $participante->getNomeParticipante(),
            ':email' => $participante->getEmail(),
            ':telefone' => $participante->getTelefone(),
            ':id' => $id_participante
        ]);
    }
    public function excluir(int $id_participante): bool
    {

        $sql = "DELETE FROM participantes
        WHERE id_participante = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id_participante
        ]);
    }
}


?>