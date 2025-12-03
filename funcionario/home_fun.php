<?php
session_start();
require_once('../src/config/conexao.php');

if (!isset($_SESSION['funcionario_logado'])) {
    header('Location: login_fun.php');
    exit();
}

$funcionario = $_SESSION['funcionario_logado'];

$stmt = $pdo->prepare("SELECT * FROM funcionario WHERE id_funcionario = :id");
$stmt->bindParam(':id', $funcionario['id_funcionario']);
$stmt->execute();
$funcionario_atualizado = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['bater_ponto'])) {
    $id_funcionario = $funcionario['id_funcionario'];

    $sql = "UPDATE funcionario SET carga = 8 WHERE id_funcionario = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id_funcionario);
    $stmt->execute();

    $_SESSION['funcionario_logado']['carga'] = 8;

    header("Location: home_fun.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/assets/css/home_fun.css">
    <title>Painel do Funcionário</title>
</head>
<body>

<header class="header">
    <div class="header-left">
        <h3><?php echo htmlspecialchars($funcionario_atualizado['nome']) . ' ' .  ($funcionario_atualizado['sobrenome']); ?></h3>
        <span class="cargo"><?php echo htmlspecialchars($funcionario_atualizado['especialidade']); ?></span>
    </div>

    <div class="header-actions">

        <form method="POST" class="ponto-form" 
              onsubmit="return confirm('Confirmar batida de ponto?');">
            <button type="submit" name="bater_ponto" class="btn ponto">
                ⏱ Bater Ponto
            </button>
        </form>

        <a href="logout_fun.php" onclick="return confirm('Tem certeza que deseja sair?');"
           class="btn sair">
           ↳ Sair
        </a>

    </div>
</header>


<div class="container">

    <h2 class="titulo">
        Bem-vindo de volta
    </h2>

    <div class="cards">

        <div class="card">
            <span class="label">Registro</span>
            <span class="valor"><?php echo htmlspecialchars($funcionario_atualizado['registro']); ?></span>
        </div>

        <div class="card">
            <span class="label">Função</span>
            <span class="valor"><?php echo htmlspecialchars($funcionario_atualizado['especialidade']); ?></span>
        </div>

        <div class="card">
            <span class="label">Carga Disponível</span>
            <span class="valor"><?php echo htmlspecialchars($funcionario_atualizado['carga']); ?></span>
        </div>

    </div>

    <a href="listar_consulta_fun.php" class="btn listar">
        Ver Consultas
    </a>

</div>

</body>

</html>
