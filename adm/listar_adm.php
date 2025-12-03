<?php

session_start();

require_once('../src/config/conexao.php');

if (!isset($_SESSION['admin_logado'])) {
    header("Location:login_adm.php");
    exit();
}

$administradores = [];

try {
    $stmt = $pdo -> prepare("SELECT * FROM ADMINISTRADOR");
    $stmt -> execute();
    $administradores = $stmt -> fetchALL (PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "<p style='color:red;'> Erro ao listar administradores:" . $e -> getMessage() . "</p>";
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/assets/css/listar_pet.css">
    <title>Listar Administradores</title>
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

<br><br><br>
    <h2>Administradores Cadastrados</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Senha</th>
            <th>Ativo</th>
            <th>Ações</th>
        </tr>
        <?php foreach($administradores as $adm): ?>
            <tr>
                <td><?php echo $adm['ADM_ID']; ?></td>
                <td><?php echo $adm['ADM_NOME']; ?></td>
                <td><?php echo $adm['ADM_EMAIL']; ?></td>
                <td><?php echo $adm['ADM_SENHA']; ?></td>
                <td><?php echo $adm['ADM_ATIVO'] == 1 ? 'Sim' : 'Não '; ?></td>

                <td>
                    <a href="editar_adm.php?id=<?php echo $adm['ADM_ID']; ?>" class="action-btn">Editar</a>
                    <a href="excluir_adm.php?id=<?php echo $adm['ADM_ID']; ?>" class="action-btn delete-btn" onclick="return confirmDeletion();" >Excluir </a> 
                </td>
            </tr>
        <?php endforeach ?>
    </table>
    <p></p>

</body>
</html>