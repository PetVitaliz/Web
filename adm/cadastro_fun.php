<?php
session_start();
require_once('../src/config/conexao.php');

if (!isset($_SESSION['admin_logado'])) {
    header('Location: login_adm.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $sobrenome = trim($_POST['sobrenome']);
    $especialidade = $_POST['especialidade'];
    $registro = trim($_POST['registro']);
    $senha = $_POST['senha'];
    $ativo = isset($_POST['ativo']) ? 1 : 0;
    $carga = 8;

    if (empty($nome) || empty($sobrenome) || empty($especialidade) || empty($registro) || empty($senha)) {
        echo "<p style='color:red;'>Preencha todos os campos obrigatórios.</p>";
    } else {
        try {
            // Gera o hash seguro da senha
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "INSERT INTO funcionario (nome, sobrenome, registro, especialidade, senha, ativo, carga)
                    VALUES (:nome, :sobrenome, :registro, :especialidade, :senha, :ativo, :carga)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':sobrenome', $sobrenome);
            $stmt->bindParam(':registro', $registro);
            $stmt->bindParam(':especialidade', $especialidade);
            $stmt->bindParam(':senha', $senha_hash);
            $stmt->bindParam(':ativo', $ativo);
            $stmt->bindParam(':carga', $carga);
            $stmt->execute();

            echo "<p style='color:green;'>Funcionário cadastrado com sucesso!</p>";
        } catch (PDOException $e) {
            echo "<p style='color:red;'>Erro ao cadastrar funcionário: " . $e->getMessage() . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cadastrar Funcionário</title>
<link rel="stylesheet" href="../src/assets/css/cadastrar_pet.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
<div class="container">
    <h2>Cadastrar Funcionário</h2>

    <form method="post">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" required>

            <label for="sobrenome" class="form-label">Sobrenome:</label>
            <input type="text" name="sobrenome" id="sobrenome" class="form-control" required>


            <label for="especialidade" class="form-label">Especialidade:</label>
            <select name="especialidade" id="especialidade" class="form-select" required>
                <option value="">Selecione...</option>
                <option value="Veterinario">Veterinário</option>
                <option value="Tosador">Tosador</option>
            </select>

            <label for="registro" class="form-label">Registro:</label>
            <input type="text" name="registro" id="registro" class="form-control" required>

            <label for="senha" class="form-label">Senha:</label>
            <input type="password" name="senha" id="senha" class="form-control" required>

        <div class="form-check mb-3">
            <input type="checkbox" name="ativo" id="ativo" class="form-check-input" value="1" checked>
            <label for="ativo" class="form-check-label">Ativo</label>
        </div>

        <button type="submit">Cadastrar</button>
    </form>


</div>
</body>
</html>
