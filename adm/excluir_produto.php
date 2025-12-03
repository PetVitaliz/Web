<?php
session_start();
if (!isset($_SESSION['admin_logado'])) {
    header("Location: login_adm.php");
    exit();
}

require_once('../src/config/conexao.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: listar_produtos.php");
    exit();
}

$id_produto = $_GET['id'];

try {
    $sql = "DELETE FROM produtos WHERE id_produto = :id";
    
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindParam(':id', $id_produto, PDO::PARAM_INT);
    
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        header("Location: listar_produtos.php?status=delete_success");
    } else {
        header("Location: listar_produtos.php?status=not_found");
    }
    
    exit();
    
} catch (PDOException $e) {
    error_log("Erro ao excluir produto: " . $e->getMessage());
    header("Location: listar_produtos.php?status=delete_error");
    exit();
}