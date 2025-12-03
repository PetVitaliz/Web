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
    $sql_select = "SELECT * FROM produtos WHERE id_produto = :id";
    $stmt_select = $pdo->prepare($sql_select);
    $stmt_select->bindParam(':id', $id_produto, PDO::PARAM_INT);
    $stmt_select->execute();
    
    $produto = $stmt_select->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        header("Location: listar_produtos.php");
        exit();
    }

} catch (PDOException $e) {
    echo "<p style='color:red;'>Erro ao buscar produto: " . $e->getMessage() . "</p>";
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $beneficios = $_POST['beneficios']; 

    try {
        $sql_update = "UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, beneficios = :beneficios WHERE id_produto = :id";
        $stmt_update = $pdo->prepare($sql_update);
        
        $stmt_update->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt_update->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt_update->bindParam(':preco', $preco, PDO::PARAM_STR); 
        $stmt_update->bindParam(':beneficios', $beneficios, PDO::PARAM_STR);
        $stmt_update->bindParam(':id', $id_produto, PDO::PARAM_INT);

        if ($stmt_update->execute()) {
            header("Location: listar_produtos.php?status=edit_success");
            exit();
        } else {
            echo "<p style='color:red;'>Erro ao atualizar o produto.</p>";
        }
    } catch (PDOException $e) {
        echo "<p style='color:red;'>Erro de execução: " . $e->getMessage() . "</p>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/assets/css/cadastrar_pet.css">
    <title>Editar Produto</title>
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


input[type="text"],
input[type="number"],
textarea {
    width: 100%;
    max-width: 600px;
    padding: 12px 14px;
    font-size: 15px;
    border-radius: 8px;
    border: 2px solid #d0d0d0;
    outline: none;
    background: #fafafa;
    transition: 0.25s;
    display: block;
    margin-bottom: 18px;
    font-family: "Poppins", sans-serif;
}

input[type="text"]:focus,
input[type="number"]:focus,
textarea:focus {
    border-color: #2B357D;
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(43, 53, 125, 0.20);
}

textarea {
    min-height: 140px;
    resize: vertical; /* permite mudar tamanho só vertical */
    line-height: 1.5;
}

label {
    position: relative;
    font-weight: 600;
    font-size: 15px;
    margin-bottom: 6px;
    display: block;
    color: #2B357D;
}

button[type="submit"] {
    background: #2B357D;
    color: white;
    padding: 12px 20px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    transition: 0.25s;
}

button[type="submit"]:hover {
    background: #232c6a;
}

.form-container {
    margin-left: 630px;  /* o quanto quer para a direita */
    margin-top: 40px;
    max-width: 600px;
}

</style>

<a href="painel_adm.php" class="seta">
        <img src="../src/assets/img/seta.png" alt="" height="50px">
</a>
    
</body>
</html>

<div class="form-container">

<form action="" method="POST">

    <label for="nome">Nome:</label>
    <input value="<?= htmlspecialchars($produto['nome'] ?? '') ?>" type="text" name="nome" id="nome" required>

    <label for="descricao">Descrição:</label>
    <textarea name="descricao" id="descricao" rows="5" required><?= htmlspecialchars($produto['descricao'] ?? '') ?></textarea>

    <label for="preco">Preço:</label>
    <input value="<?= htmlspecialchars($produto['preco'] ?? '') ?>" type="number" step="0.01" name="preco" id="preco" required>

    <label for="beneficios">Benefícios (Um por Linha):</label>
    <textarea name="beneficios" id="beneficios" rows="5" required><?= htmlspecialchars($produto['beneficios'] ?? '') ?></textarea>

    <button type="submit">Salvar Alterações</button>

</form>

</div>

