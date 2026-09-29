
<?php


require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../services/ParticipanteService.php';
require_once __DIR__ . '/../models/AtividadeModel.php';


$service = new ParticipanteService($pdo);

$participante = new ParticipanteModel(
    'Partiipante',
    'h@gamil.com',
    '31111211'
);

$service->cadastrarParticipante($participante);


$participante = $service->listarParticipantes();
echo "<pre>";
print_r($participante);
echo "</pre>";

$participante = $service->buscarPorIdParticipante(1);
echo "<pre>";
print_r($participante);
echo "</pre>";

/*
$participanteAtualizado = new ParticipanteModel(
    'Atualizado',
    'atualizado@gmail.com',
    '319122'
);
*/

#$service->atualizarParticipante(2,$participanteAtualizado);

#$service->excluirParticipante(1)
?>