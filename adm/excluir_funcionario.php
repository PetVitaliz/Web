<?php
session_start();
require_once('../src/config/conexao.php');

// Verifica se o admin está logado
if (!isset($_SESSION['admin_logado'])) {
    header("Location: login_adm.php");
    exit();
}

// Verifica se o ID foi informado
if (!isset($_GET['id'])) {
    echo "<p style='color:red;'>ID do funcionário não informado.</p>";
    exit();
}

$id_funcionario = $_GET['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM funcionario WHERE id_funcionario = :id_funcionario");
    $stmt->bindParam(':id_funcionario', $id_funcionario, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: listar_funcionarios.php");
    exit();

} catch (PDOException $e) {
    echo "<p style='color:red;'>Erro ao excluir funcionário: " . $e->getMessage() . "</p>";
}
?>
