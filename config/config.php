
<?php

$host = 'localhost';
$dbname = 'festival_experiencia';
$username = 'root';
$senha = 'senac@2026';

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $senha

    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
    echo "Conectado";
} catch (PDOException $e) {

    die("Erro na conexão $e");
}




?>