<?php
require_once 'conexao.php';

$delete = $pdo->prepare("
    DELETE FROM reset_senha
    WHERE expira_em < NOW()
");
$delete->execute();
