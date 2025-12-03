<?php

// Local

// $host = 'localhost';//especifica o nome do host onde o banco de dados MySQL está hospedado
// $db = 'Alpha2'; //nome do nosso banco de dados e que desejamos conectar
// $user = 'root'; //usuário do BD
// $pass = ''; //senha do BD (sem espaço)
// $charset = 'utf8mb4'; //define o conjunto de caracteres usado para comunicação com o banco de dados

// $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// $options = [
// PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
// PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
// PDO::ATTR_EMULATE_PREPARES => false,
// ];

// try{
//     $pdo = new PDO($dsn, $user, $pass, $options);
// }catch (\PDOException $e){
//     echo 'Erro ao conectar com o banco de dados: ' . $e->getMessage();
// }

// Aiven

require_once __DIR__ . '/env.php';

$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo "Erro ao conectar: " . $e->getMessage();
}
