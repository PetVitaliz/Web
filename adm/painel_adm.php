<?php
session_start();

if (!isset($_SESSION['admin_logado'])) {
    header('Location:login_adm.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Administrador</title>
    <link rel="stylesheet" href="../src/assets/css/painel_adm.css">
</head>

<body>

<header class="topo">
    <h1>Painel do Administrador</h1>

    <a href="logout_adm.php" class="logout" onclick="return confirm('Deseja realmente sair?')">
        Sair
    </a>
</header>

<div class="container">

    <h2 class="boas-vindas">Bem-vindo</h2>

    <div class="grid">
        <a href="cadastrar_adm.php" class="card">Cadastrar Administradores</a>
        <a href="listar_adm.php" class="card">Listar Administradores</a>

        <a href="cadastro_fun.php" class="card">Cadastrar Funcionário</a>
        <a href="listar_funcionarios.php" class="card">Listar Funcionários</a>

        <a href="cadastrar_produto.php" class="card">Cadastrar Produtos</a>
        <a href="listar_produtos.php" class="card">Listar Produtos</a>
        
    </div>

</div>

</body>
</html>
