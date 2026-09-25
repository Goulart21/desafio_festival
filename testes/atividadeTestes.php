
<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/atividades.php';
require_once __DIR__ . '/../services/Atividadeservice.php';

$service = new Atividadeservice($pdo);


$atividade = new Atividades(
    'Teste',
    'descricao',
    '2026-02-02',
    '12:00',
    '13:00',
    'palacio',
    21
);

$service->cadastrarAtividade($atividade);



$atividade = $service->listarAtividade();

echo '<pre>';
print_r($atividade);
echo '<pre>';

$atividade = $service->buscarPorId(1);
echo '<pre>;';
print_r($atividade);
echo '<prep>';

$atividadeAtualizada = new Atividades(
    'Atualizada',
    'atualizada',
    '2026-03-03',
    '15:00',
    '17:00',
    'palacio',
    10
);

$atividade = $service->atualizarAtividade(1,$atividadeAtualizada);

$atividade = $service->excluir(1);

?>