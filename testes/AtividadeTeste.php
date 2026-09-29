
<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/AtividadeModel.php';
require_once __DIR__ . '/../services/Atividadeservice.php';


$service = new AtividadeService($pdo);

/*
$atividade = new AtividadeModel(
    'atividade um',
    'atividade descricao',
    '2026-10-10',
    '12:00',
    '13:00',
    'palacio',
    1,
    
);

$service->cadastrarAtividade($atividade);
*/
$atividades = $service->listarAtividade();
echo "<pre>";
print_r($atividades);
echo "</pre>";

$atividadeAtualizada = new AtividadeModel(
    'Atividade atualizada',
    'descricao',
    '2026-12-12',
    '14:00',
    '19:00',
    'estatuto',
    50
);

#$service->atualizarAtividade(1,$atividadeAtualizada);

$service->excluir(2);


?>