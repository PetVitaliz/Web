<?php
session_start();
require_once('../src/config/conexao.php');

// 1. Verifica se está logado
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: login.php");
    exit();
}

// 2. Verifica se veio o ID do produto
if (!isset($_GET['id'])) {
    header("Location: homeL.php"); // Voltar pra home se não tiver ID
    exit();
}

$id_produto = $_GET['id'];
$id_usuario = $_SESSION['usuario_logado']['id_usuario']; // Certifique-se que seu login salva o 'id' na sessão

// 3. Busca informações do produto para mostrar na tela
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id_produto = :id");
$stmt->bindParam(':id', $id_produto);
$stmt->execute();
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    echo "Produto não encontrado.";
    exit();
}

// 4. Processar a "Compra"
if (isset($_POST['confirmar_compra'])) {
    try {
        // Insere na tabela de assinaturas
        $sql = "INSERT INTO assinaturas (id_usuario, id_produto) VALUES (:user, :prod)";
        $stmt_insert = $pdo->prepare($sql);
        $stmt_insert->bindParam(':user', $id_usuario);
        $stmt_insert->bindParam(':prod', $id_produto);
        $stmt_insert->execute();

        // Redireciona para a página "Meu Plano"
        header("Location: planos.php?sucesso=1");
        exit();
    } catch (PDOException $e) {
        echo "Erro ao processar: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Confirmar Pagamento - PetVitaliz</title>
    <link rel="stylesheet" href="./src/assets/css/home_logada.css">
    <style>
        .pagamento-container {
            max-width: 600px;
            margin: 100px auto;
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        .pagamento-info h2 { color: #2B357D; }
        .pagamento-preco { font-size: 40px; color: #2B357D; font-weight: bold; margin: 20px 0; }
        .btn-confirmar {
            background-color:rgb(63, 146, 66);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            width: 100%;
        }
        .btn-cancelar {
            background-color:rgb(190, 53, 53);
            margin-top: 10px;
            display: inline-block;
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .seta img {
        position: absolute;
        top: 50px;
        left: 40px;
        }
    </style>
</head>
<body style="background-color: #f4f4f4;">
<a href="../homeL.php" class="seta">
    <img src="../src/assets/img/seta.png" height="50px">
</a>
    <div class="pagamento-container">
        <h1>Resumo do Pedido</h1>
        <hr>
        
        <div class="pagamento-info">
            <h2><?= htmlspecialchars($produto['nome']) ?></h2>
            <p><?= htmlspecialchars($produto['descricao']) ?></p>
            
            <div class="pagamento-preco">
                R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
            </div>

            <form method="POST">
                <button type="submit" name="confirmar_compra" class="btn-confirmar">Confirmar Pagamento (Simulação)</button>
            </form>
            
            <br>
            <a href="../homeL.php" class="btn-cancelar">Cancelar</a>
        </div>
    </div>

</body>
</html>