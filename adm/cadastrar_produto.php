<?php
session_start();

if (!isset($_SESSION['admin_logado'])) {
    header("Location: login_adm.php");
    exit();
}

require_once('../src/config/conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $beneficios = $_POST['beneficios']; 

    try {
        $sql = "INSERT INTO produtos (nome, descricao, preco, beneficios) VALUES (:nome, :descricao, :preco, :beneficios)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
        $stmt->bindParam(':beneficios', $beneficios, PDO::PARAM_STR); 

        $stmt->execute();

        $produto_id = $pdo->lastInsertId();

        echo "<script>
setTimeout(function() {
    window.location.href = 'painel_adm.php';
}, 1000);
</script>";
    } catch (PDOException $e) {
        echo "<p style='color:red;'>Erro ao realizar cadastro: " . $e->getMessage() . "</p>";
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


.seta img {
    position: absolute;
    top: 210px;
    left: 40px;
}

</style>

<a href="painel_adm.php" class="seta">
    <img src="../src/assets/img/seta.png" alt="" height="50px">
</a>

<br><br>

<div class="form-container">
    <h2 class="form-title">Cadastro de Produto</h2>

    <form method="POST">

        <div class="form-grid">

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" required>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea name="descricao" id="descricao" required rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="preco">Preço</label>
                <input type="number" step="0.01" name="preco" id="preco" required>
            </div>

            <div class="form-group">
                <label for="beneficios">Benefícios do Plano (Um por Linha)</label>
                <textarea name="beneficios" id="beneficios" rows="5"  placeholder="Exemplo:
Consulta de saúde ilimitada
Cobertura de emergência
20% de desconto em produtos"></textarea>
            </div>

        </div>

        <div class="form-button-area">
            <button type="submit" class="btn-cadastrar">Cadastrar</button>
        </div>


    </form>
</div>

</body>
</html>
