
<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Participantes.php';

class ParticipanteService
{

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function cadastrar(Participantes $participantes)
    {
        $sql = "SELECT COUNT(*)
        FROM participantes
        WHERE email = :email";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':email' => $participantes->getEmail()
        ]);

        if ($stmt->fetchColumn() > 0) {
            return 'EMAIL_DUPLICADO';
        }

        $sql = "INSERT INTO participantes (nome,email, telefone) VALUES  (:nome, :email, :telefone)";

        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute([
            ':nome' => $participantes->getNomeParticipante(),
            ':email' => $participantes->getEmail(),
            ':telefone' => $participantes->getTelefone()
        ])) {
            return 'SUCESSO';
        }

        return 'ERRO';
    }

    public function listar(): array
    {

        $sql = "SELECT * FROM participantes ORDER BY nome_participante";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): ?array
    {

        $sql = "SELECT * FROM participantes WHERE id_participante = :id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        $participantes = $stmt->fetch(PDO::FETCH_ASSOC);
        return $participantes ?: null;
    }

    public function atualizar(int $id_participante, Participantes $participantes): bool
    {

        $sql = "UPDATE participantes
    SET nome = :nome,
    email = :email,
    telefone = :telefone
    WHERE id_participante = :id";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':nome' => $participantes->getNomeParticipante(),
        ':email' =>  $participantes->getEmail(),
        ':telefone' => $participantes->getTelefone(),
        ':id' => $id_participante
    ]);
    }

    public function excluir(int $id_participante): bool{

        $sql = "DELETE FROM participantes
        WHERE id_participante = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id_participante
        ]);
    }
}

?>