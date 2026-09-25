
<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/inscricoes.php';
require_once __DIR__ . '/../services/InscricaoService.php';

$service = new InscricaoService($pdo);

/*
$inscricao = new Inscricoes(
    3,
    3
);


$service->cadastrarInscricao($inscricao);
*/

$inscricao = $service->listarInscricoes();
echo "<pre>";
print_r($inscricao);
echo "<pre>";

$inscricaoPorId = $service->buscarInscricaoPorId(2);
echo "<pre>";
print_r($inscricaoPorId);
echo "<pre>";

$partipantes = $service->listarPorAtividade(3);
echo "<pre>";
print_r($partipantes);
echo "</pre>";


$inscricaoDuplicada = new Inscricoes(
    3,
    3
);


$resultado = $service->cadastrarInscricao($inscricaoDuplicada);

if ($resultado === 'DUPLICADA') {

    echo "Inscrição duplicada foi impedida";

} else {

    echo "ERRO: inscrição duplicada não foi impedida";

}
?>