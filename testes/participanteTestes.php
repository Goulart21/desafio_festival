

<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/participantes.php';
require_once __DIR__ . '/../services/ParticipanteService.php';

$service = new ParticipanteService($pdo);

$participante = new Participantes(
    'Tetste',
    'pedro@gmail.com',
    '310000'
);

if($service->cadastrar($participante)){
    echo "Participane cadastrado";
}

$participante = $service->listar();
echo "<pre>";
print_r($participante);
echo "<pre>";

$participante = $service->excluir(3);

$participante = $service->buscarPorId(2);
echo "<pre>";
print_r($participante);
echo "<pre>";



$participanteAtualizado = new Participantes(
    'Atualizado',
    'a@gmail.com',
    '31999'
);

if($service->atualizar(2,$participanteAtualizado)){
    echo "AA";
}


?>