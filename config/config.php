
<?php

$host = 'localhost';
$dbname = 'festival_experiencia_viva';
$username = 'root';
$password = 'senac@2026';

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    echo "conectado";
} catch (PDOException $e) {

    die("Erro ao conectar");
}


?>