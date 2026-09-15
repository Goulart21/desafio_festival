

<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Atividade.php';
require_once __DIR__ . '/../Services/AtividadeService.php';

$service = new AtividadeService($pdo);

/*
$atividade = new Atividade(
    'Teste Atividade',
    'teste descricao',
    '2026-02-02',
    '12:00',
    '13:00',
    'palacio',
    12
);

if($service->cadastrarAtividade($atividade)){
    echo "Atividade cadastrado com sucesso";
}
else{
    echo "Erro";
}

*/

$atividade = $service->listarAtividade();
echo "<pre>";
print_r($atividade);
echo "<pre>";

$atividade = $service->buscarAtividadePorId(2);
echo "<pre>";
print_r($atividade);
echo "<pre>";

$atividadeAtualizada = new Atividade(
    'Atualizada',
    'Atualizada',
    '2028-02-10',
    '15:00',
    '19:00',
    'ligar',
    100
);

if($service->atualizarAtividade(1,$atividadeAtualizada)){
    echo "Atividade Atualizada";
}

if($service->excluir(2)){
    echo "Atividade excluida";
}


?>