

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




?>