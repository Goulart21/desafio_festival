
<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/InscricaoModel.php';
require_once __DIR__ . '/../services/InscricaoService.php';

$service = new InscricaoService($pdo);

/*
$inscricao = new InscricaoModel(
    2,
    4
);

$service->cadastrarInscricao($inscricao);
*/

$inscricoes = $service->listarInscricoes();
echo "<pre>";
print_r($inscricoes);
echo "</pre>";

$inscricao = $service->buscarInscricaoPorId(2);
echo "<pre>";
print_r($inscricao);
echo "</pre>";

/*
$inscricaoDuplicada = new InscricaoModel(
    2,
    4
);

if($service->cadastrarInscricao($inscricaoDuplicada)){
    echo "INscrição já realizada";
}
    */

$service->cancelarInscricao(2);

$idAtividade = 3;


$idInscricao = 41;


$idOutroParticipante = 9;





$novaInscricao = new InscricaoModel(
    5,
    4
);

if ($service->cadastrarInscricao($novaInscricao)) {
    echo "Nova inscrição realizada. A vaga foi liberada corretamente";
} else {
    echo "ERRO";
}

?>