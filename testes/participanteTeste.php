

<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../Services/ParticipanteService.php';

$service = new ParticipanteService($pdo);

$participantes = new Participantes(
    'Nome Teste',
    'p@gmail.com',
    '319962020'
);

if($service->cadastrar($participantes)){
    echo"Participante cadastrado";
}

$participantes = $service->listar();
echo "<pre>";
print_r($participantes);
echo "<pre>";

$participantes = $service->buscarPorId(1);
echo "<pre>";
print_r($participantes);
echo "<pre>";

$participantesAtualizado = new Participantes(
    'Atualizado',
    'a@gmail.com',
    '31922222222'
);

if($service->atualizar(1,$participantesAtualizado)){
    echo"Participante atualizado";
}

if($service->excluir(2)){
    echo "participante excluido";
}



?>