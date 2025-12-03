<?php
session_start();
require_once('../src/config/conexao.php');
if (!isset($_SESSION['admin_logado'])) {
    header("Location: login_adm.php");
    exit();
}

$produtos = [];

try {
    $stmt = $pdo->prepare("SELECT * FROM produtos ORDER BY id_produto ASC");
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p style='color:red;'>Erro ao listar produtos: " . $e->getMessage() . "</p>";
}
?>

<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/assets/css/listar_pet.css">
    <title>Lista de Produtos</title>
    <script>
        function confirmDeletion() {
            return confirm("Tem certeza que deseja excluir este produto?");
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

.seta img {
    position: absolute;
    top: 170px;
    left: 40px;
}


</style>

<a href="painel_adm.php" class="seta">
        <img src="../src/assets/img/seta.png" alt="" height="50px">
</a>

<h2>Lista de Produtos</h2>

<?php if (count($produtos) > 0): ?>


<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Preço</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($produtos as $p): ?>
    <tr>
        <td><?= htmlspecialchars($p['id_produto']); ?></td>
        <td><?= htmlspecialchars($p['nome']); ?></td>
        <td><?= htmlspecialchars($p['descricao']); ?></td>
        <td>R$ <?= number_format($p['preco'], 2, ',', '.'); ?></td>
        <td>
            <a href="editar_produto.php?id=<?php echo $p['id_produto']; ?>" class="action-btn">Editar</a>
            <a href="excluir_produto.php?id=<?php echo $p['id_produto']; ?>" class="action-btn delete-btn" onclick="return confirmDeletion();">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>


<?php else: ?>


<p style="text-align:center;">Nenhum produto cadastrado ainda.</p>


<?php endif; ?>

</body>
</html>
