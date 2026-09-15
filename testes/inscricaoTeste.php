

<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Inscricao.php';
require_once __DIR__ . '/../Services/InscricaoService.php';


$service = new InscricaoService($pdo);

/*
$inscricao = new Inscricao(
    1,
    2
);

if($service->cadastrarInscricao($inscricao)){
    echo "Inscrito";
}
else{
    echo "Err";
}
    */

$inscricoes = $service->listarInscricoes();
echo "<pre>";
print_r($inscricoes);
echo "<pre>";

$inscricaoEncontrada = $service->buscarInscricaoPorId(21);
echo "<pre>";
print_r($inscricaoEncontrada);
echo "<pre>";

$participantes = $service->listarPorAtividade(2);
echo"<pre>";
print_r($participantes);
echo"<pre>";

/*
$inscricaoDuplicada = new Inscricao(
    3,2
);
if($service->cadastrarInscricao($inscricaoDuplicada)){
    echo "Duplicada";
}
*/

if($service->cancelarInscricao(21)){
    echo "Inscricao cancelada";
}

$idAtividade = 3;
$idInscricao = 22;
$idOutroParticipante = 3;

if($service->cancelarInscricao($idInscricao)){
    echo "INscricao cancelada";
}

$novaInscricao = new Inscricao(
    $idOutroParticipante,
    $idAtividade
);

if($service->cadastrarInscricao($novaInscricao)){
    echo "Nova inscricao cadastrada, a vaga foi liberada";
}
?>