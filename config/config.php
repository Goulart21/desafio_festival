

<?php

$host = 'localhost';
$dbname = 'festival_experiencia_viva_1';
$user = 'root';
$senha = 'senac@2026';

try{

    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $senha
    );

    $pdo->setAttribute(
        PDO::ATTR_AUTOCOMMIT,
        PDO::ERRMODE_EXCEPTION
    );

    $pdo->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );
    
}catch(Exception $e){

    die("Sem conexão");
}



?>