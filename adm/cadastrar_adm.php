<?php

session_start();

require_once('../src/config/conexao.php');

if (!isset($_SESSION['admin_logado'])) {
    header('Location:login_adm.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD']== 'POST') {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $ativo = isset($_POST['ativo']) ? 1 : 0;

    try {
        $sql = "INSERT INTO ADMINISTRADOR (ADM_NOME, ADM_EMAIL, ADM_SENHA, ADM_ATIVO) VALUES (:nome, :email, :senha, :ativo)";

        $stmt = $pdo -> prepare($sql);
        $stmt -> bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt -> bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senhaHash, PDO::PARAM_STR);
        $stmt -> bindParam(':ativo', $ativo, PDO::PARAM_STR);

        $stmt -> execute();

        $adm_id = $pdo -> lastInsertId();

        echo "<p style='color:green;'>Administrador cadastrado com sucesso! ID: " . $adm_id . "</p>";
    } catch(PDOEsception $e){
        echo "<p style='color:red;'>Erro ao cadastrar administrador: " . $e -> getMessage() . "</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/assets/css/cadastrar_pet.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastro de Administrador</title>
</head>
<body>

<header class="topo">
    <h1>Painel do Administrador</h1>

    <a href="logout_adm.php" class="logout" onclick="return confirm('Deseja realmente sair?')">
        Sair
    </a>
</header>

<style>
    .topo {
    width: 100%;
    background: #2B357D;
    color: white;
    padding: 18px 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.topo h1 {
    font-size: 22px;
    font-weight: bold;
}

.topo .logout {
    background: #ff4d4d;
    padding: 8px 16px;
    border-radius: 6px;
    text-decoration: none;
    color: white;
    font-weight: 600;
    transition: 0.2s;
}

.topo .logout:hover {
    background: #e63939;
}  

h2 {
    display: flex;
    justify-content: center;
    position: relative;
    font-size: 30px;
        }
</style>

<a href="painel_adm.php" class="seta">
        <img src="../src/assets/img/seta.png" alt="" height="50px">
</a>

<br><br><br>
    <h2>Cadastrar Administrador</h2>
    
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        <p>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <p>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <p>
        
        <div class="form-check mb-3">
            <input type="checkbox" name="ativo" id="ativo" class="form-check-input" value="1" checked>
            <label for="ativo" class="form-check-label">Ativo</label>
        </div>

        

        <button type="submit">Cadastrar adiministrador</button>
        
    </form>
</body>
</html>