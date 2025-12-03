<?php
session_start();

require_once('../src/config/conexao.php');

if (!isset($_SESSION['admin_logado'])) {
    header("Location:login_adm.php");
    exit();
}


if (!isset($_GET['id'])) {
    echo "<p style='color:red;'>ID do ADM não informado.</p>";
    exit();
}

$adm_id = $_GET['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM administrador WHERE ADM_ID = :adm_id");
    $stmt->bindParam(':adm_id', $adm_id, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: listar_adm.php");
    exit();

} catch (PDOException $e) {
    echo "<p style='color:red;'>Erro ao excluir adm: " . $e->getMessage() . "</p>";
}
?>
