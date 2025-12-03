<?php
session_start();

require_once('../src/config/conexao.php');


if (!isset($_SESSION['usuario_logado'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "<p style='color:red;'>ID do pet não informado.</p>";
    exit();
}

$id_pet = $_GET['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM pet WHERE id_pet = :id_pet");
    $stmt->bindParam(':id_pet', $id_pet, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: listar_pet.php");
    exit();

} catch (PDOException $e) {
    echo "<p style='color:red;'>Erro ao excluir pet: " . $e->getMessage() . "</p>";
}
?>
