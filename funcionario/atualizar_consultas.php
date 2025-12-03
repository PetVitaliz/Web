<?php
require_once('../src/config/conexao.php');

$agora = new DateTime();

// 1. Atualizar status para "em andamento"
$sqlAndamento = $pdo->prepare("
    UPDATE consulta 
    SET status = 'em_andamento'
    WHERE status != 'finalizado'
    AND CONCAT(data_consulta, ' ', hora_inicio) <= NOW()
    AND CONCAT(data_consulta, ' ', hora_fim) >= NOW()
");
$sqlAndamento->execute();


// 2. Deletar consultas não finalizadas que passaram mais de 5 min após o fim
$sqlDelete = $pdo->prepare("
    DELETE FROM consulta
    WHERE status != 'finalizado'
    AND CONCAT(data_consulta, ' ', hora_fim) < DATE_SUB(NOW(), INTERVAL 5 MINUTE)
");
$sqlDelete->execute();
?>
