<?php
session_start();
require_once('../src/config/conexao.php');

// Verifica se o admin está logado
if (!isset($_SESSION['admin_logado'])) {
    header("Location: login_adm.php");
    exit();
}

$funcionarios = [];

try {
    // Consulta todos os funcionários
    $stmt = $pdo->prepare("SELECT * FROM funcionario ORDER BY id_funcionario ASC");
    $stmt->execute();
    $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p style='color:red;'>Erro ao listar funcionários: " . $e->getMessage() . "</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/assets/css/listar_pet.css">
    <title>Lista de Funcionários</title>


    <script>
        function confirmDeletion() {
            return confirm("Tem certeza que deseja excluir este funcionário?");
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

<br><br><br>
    <h2>Lista de Funcionários</h2>

    <?php if (count($funcionarios) > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Especialidade</th>
                <th>Registro</th>
                <th>Senha</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($funcionarios as $f): ?>
                <tr>
                    <td><?php echo htmlspecialchars($f['id_funcionario']); ?></td>
                    <td><?php echo htmlspecialchars($f['nome']); ?></td>
                    <td><?php echo htmlspecialchars($f['sobrenome']); ?></td>
                    <td><?php echo htmlspecialchars($f['especialidade']); ?></td>
                    <td><?php echo htmlspecialchars($f['registro']); ?></td>
                    <td><?php echo htmlspecialchars($f['senha']); ?></td>
                    <td>
                        <a href="editar_funcionario.php?id=<?php echo $f['id_funcionario']; ?>" class="action-btn">Editar</a>
                        <a href="excluir_funcionario.php?id=<?php echo $f['id_funcionario']; ?>" class="action-btn delete-btn" onclick="return confirmDeletion();">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Nenhum funcionário cadastrado ainda.</p>
    <?php endif; ?>


</body>
</html>
