<?php
session_start();
require_once('../src/config/conexao.php');

if (!isset($_SESSION['admin_logado'])) {
    header("Location: login_adm.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "<p style='color:red;'>ID do funcionário não informado.</p>";
    exit();
}

$id_funcionario = $_GET['id'];

try {
    $stmt = $pdo->prepare("SELECT * FROM funcionario WHERE id_funcionario = :id_funcionario");
    $stmt->bindParam(':id_funcionario', $id_funcionario, PDO::PARAM_INT);
    $stmt->execute();
    $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$funcionario) {
        echo "<p style='color:red;'>Funcionário não encontrado.</p>";
        exit();
    }
} catch (PDOException $e) {
    echo "<p style='color:red;'>Erro ao buscar funcionário: " . $e->getMessage() . "</p>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $especialidade = $_POST['especialidade'];
    $registro = $_POST['registro'];
    $senha = $_POST['senha'];
    $ativo = isset($_POST['ativo']) ? 1 : 0;


    try {
        $stmt_update = $pdo->prepare("
            UPDATE funcionario 
            SET nome = :nome, sobrenome = :sobrenome, registro = :registro, senha = :senha, 
            especialidade = :especialidade, ativo = :ativo 
            WHERE id_funcionario = :id_funcionario
        ");
        $stmt_update->bindParam(':nome', $nome);
        $stmt_update->bindParam(':sobrenome', $sobrenome);
        $stmt_update->bindParam(':registro', $registro);
        $stmt_update->bindParam(':especialidade', $especialidade);
        $stmt_update->bindParam(':senha', $senha);
        $stmt_update->bindParam(':ativo', $ativo, PDO::PARAM_INT);
        $stmt_update->bindParam(':id_funcionario', $id_funcionario, PDO::PARAM_INT);
        $stmt_update->execute();

        echo "<p style='color:green;'>Funcionário atualizado com sucesso!</p>";

        // Atualiza os dados locais
        $funcionario['nome'] = $nome;
        $funcionario['sobrenome'] = $sobrenome;
        $funcionario['especialidade'] = $especialidade;
        $funcionario['senha'] = $senha;
        $funcionario['registro'] = $registro;
        $funcionario['ativo'] = $ativo;

    } catch (PDOException $e) {
        echo "<p style='color:red;'>Erro ao atualizar funcionário: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/assets/css/cadastrar_pet.css">
    <title>Editar Administradores</title>
    <style>
        body {
            
        }
    </style>
    <script>
        function confirmDeletion() {
            return confirm("Tem certeza que deseja deletar esse adiministrador?");
        }
    </script>
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
    <h2>Editar Funcionário</h2>

    <form action="" method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($funcionario['nome']); ?>" required>
        <p>

        <label for="sobrenome">Sobrenome:</label>
        <input type="text" name="sobrenome" id="sobrenome" value="<?= htmlspecialchars($funcionario['sobrenome']); ?>" required>
        <p>

        <label for="especialidade">Especialidade:</label>
        <select name="especialidade" id="especialidade" onchange="toggleRegistro()" required>
            <option value="veterinario" <?= $funcionario['especialidade'] === 'veterinario' ? 'selected' : ''; ?>>Veterinário</option>
            <option value="tosador" <?= $funcionario['especialidade'] === 'tosador' ? 'selected' : ''; ?>>Tosador</option>
        </select>
        <p>

        
        <label for="registro">Registro:</label>
        <input type="text" name="registro" id="registro" value="<?= htmlspecialchars($funcionario['registro'] ?? ''); ?>">
        <p>

        <label for="senha">Senha:</label>
        <input type="text" name="senha" id="senha" value="<?= htmlspecialchars($funcionario['senha'] ?? ''); ?>">
        <p>

        <label for="ativo">Ativo:</label>
        <input type="checkbox" name="ativo" id="ativo" value="1" <?= $funcionario['ativo'] ? 'checked' : '' ?>>
        <p>

        <button type="submit">Salvar Alterações</button>
    </form>


    <script>
        document.addEventListener("DOMContentLoaded", toggleRegistro);
    </script>
</body>
</html>
