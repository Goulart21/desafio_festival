

<?php

class Participantes
{

    private ?int $id_participante;
    private string $nome_participante;
    private string $email;
    private string $telefone;
    private ?string $data_cadastro;

    public function __construct(
        string $nome_participante,
        string $email,
        string $telefone,
        ?int $id_participante = null,
        ?string $data_cadastro = null
    ) {
        $this->id_participante = $id_participante;
        $this->nome_participante = $nome_participante;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->data_cadastro = $data_cadastro;
    }

    public function getIdParticipante(): ?int
    {
        return $this->id_participante;
    }

    public function getNomeParticipante(): string
    {

        return $this->nome_participante;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getTelefone(): string
    {
        return $this->telefone;
    }

    public function getDataCadastro(): ?string
    {
        return $this->data_cadastro;
    }
}

?>