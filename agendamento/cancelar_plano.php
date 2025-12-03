<?php
session_start();
require_once('../src/config/conexao.php');

if (!isset($_SESSION['usuario_logado'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: planos.php");
    exit();
}

$id_assinatura = $_GET['id'];
$id_usuario = $_SESSION['usuario_logado']['id_usuario'];

try {
    // Ação de cancelamento (simulada) - Deletar a assinatura ativa
    // Usamos o id_usuario também para garantir que o usuário só possa cancelar seu próprio plano
    $sql = "DELETE FROM assinaturas WHERE id_assinatura = :id_ass AND id_usuario = :id_user";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_ass', $id_assinatura);
    $stmt->bindParam(':id_user', $id_usuario);
    $stmt->execute();

    // Redireciona de volta para a tela de planos, onde mostrará a mensagem de "não tem plano"
    header("Location: planos.php?status=cancel_success");
    exit();

} catch (PDOException $e) {
    // Em caso de erro
    header("Location: planos.php?status=cancel_error");
    exit();
}
?>