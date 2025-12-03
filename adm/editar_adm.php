<?php


session_start();

require_once('../src/config/conexao.php');

if (!isset($_SESSION['admin_logado'])) {
 header("Location:login_adm.php");
 exit();
}

if (!isset($_GET['id'])) {
    echo "<p style='color:red;'>ID do administrador não informado.</p>";
    exit();
}

$adm_id = $_GET['id'];

try {
    $stmt_adm = $pdo->prepare("SELECT * FROM ADMINISTRADOR WHERE ADM_ID = :adm_id");
    $stmt_adm->bindParam(':adm_id', $adm_id, PDO::PARAM_INT);
    $stmt_adm->execute();
    $adm = $stmt_adm->fetch(PDO::FETCH_ASSOC);

    if (!$adm) {
        echo "<p style='color:red;'>Administrador não encontrado.</p>";
        exit();
    }
} catch (PDOException $e) {
    echo "<p style='color:red;'>Erro ao buscar administrador: " . $e->getMessage() . "</p>";
    exit();
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 $nome = $_POST['nome'];
 $email = $_POST['email'];
 $senha = $_POST['senha'];
 $ativo = isset($_POST['ativo']) ? 1 : 0;


 try {
  $stmt_update_adm = $pdo->prepare("UPDATE ADMINISTRADOR SET ADM_NOME = :nome, ADM_EMAIL = :email, ADM_SENHA = :senha, ADM_ATIVO = :ativo WHERE ADM_ID = :adm_id");
  $stmt_update_adm->bindParam(':nome', $nome);
  $stmt_update_adm->bindParam(':email', $email);
  $stmt_update_adm->bindParam(':senha', $senha);
  $stmt_update_adm->bindParam(':ativo', $ativo);
  $stmt_update_adm->bindParam(':adm_id' ,$adm_id);
  $stmt_update_adm->execute();
  echo "<p style='color:green;'>Administrador atualizado com sucesso!</p>";
 } catch (PDOException $e) {
  echo "<p style='color:red;'>Erro ao atualizar administrador: " . $e->getMessage() . "</p>";
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

<h2>Editar Administrador</h2>

<form action="" method="post" enctype="multipart/form-data"> 
<label for="nome">Nome:</label>

 <input type="text" name="nome" id="nome" value="<?= $adm['ADM_NOME'] ?>" required>
 <p>

 <label for="email">Email:</label>
 <input type="text" name="email" id="email" value=" <?= $adm['ADM_EMAIL'] ?>" required>
 <p> 

 <label for="senha">Senha:</label>
 <input type="text" name="senha" id="senha" value=" <?= $adm['ADM_SENHA'] ?>" required>
 <p>

 <p>
 <label for="ativo">Ativo:</label>
 <input type="checkbox" name="ativo" id="ativo" value="1" <?= $adm['ADM_ATIVO'] ? 'checked' : '' ?>>
 <p>

<p>
 <button type="submit">Atualizar Administrador</button>
</form>
<p></p>

 
</body>
</html>