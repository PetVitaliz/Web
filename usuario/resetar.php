<?php
require_once '../src/config/conexao.php';
require_once '../src/config/limpar_tokens_expirados.php';


if (!isset($_GET['token'])) {
    die("Token inválido.");
}

$token = $_GET['token'];

// Verifica token
$stmt = $pdo->prepare("
    SELECT id_usuario, expira_em 
    FROM reset_senha 
    WHERE token = :token
    LIMIT 1
");
$stmt->bindValue(':token', $token);
$stmt->execute();

if ($stmt->rowCount() == 0) {
    die("Token inválido ou já utilizado.");
}

$dados = $stmt->fetch(PDO::FETCH_ASSOC);


if (strtotime($dados['expira_em']) < time()) {

    $del = $pdo->prepare("DELETE FROM reset_senha WHERE token = :token LIMIT 1");
    $del->bindValue(':token', $token);
    $del->execute();

    die("Link expirado. Solicite outra redefinição.");
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="../src/assets/css/reset2.css">
</head>

<body>

<header>
    <div class="logo">
        <img src="../src/assets/img/logo.png" alt="" height="80px">
    </div>
    <nav>
        <ul>
            <li><a href="../home.php">Home</a></li>
            <li><a href="../servicos.html">Nossos Serviços</a></li>
            <li><a href="../sobre-nos.html">Sobre Nós</a></li>
            <li><a href="../contato.html">Contato</a></li>
            <li><a href="../emergencia.html">Emergência</a></li>
      </ul>
    </nav>
</header>

<a href="login.php" class="seta">
    <img src="../src/assets/img/seta.png" alt="" height="50px">
</a>

<div class="reset-card">
    <h2>Defina sua nova senha</h2>

    <form action="../src/config/processar_reset.php" method="POST">
        <input type="hidden" name="token" value="<?php echo $token; ?>">

        <label>Nova senha:</label>
        <input type="password" name="senha" required>

        <label>Confirme a senha:</label>
        <input type="password" name="confirmar" required>

        <button type="submit">Redefinir</button>
    </form>
</div>

</body>
</html>