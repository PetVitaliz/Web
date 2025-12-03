<?php
require_once '../src/config/conexao.php';
require_once '../src/config/env.php';

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];

    $stmt = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :email LIMIT 1");
    $stmt->bindValue(':email', $email);
    $stmt->execute();

    $mensagemFinal = "Enviaremos um link de redefinição para esse email";

    if ($stmt->rowCount() > 0) {

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $token  = bin2hex(random_bytes(32));
        $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $ins = $pdo->prepare("
            INSERT INTO reset_senha (id_usuario, token, expira_em) 
            VALUES (:id, :token, :expira)
        ");
        $ins->bindValue(':id', $user['id_usuario']);
        $ins->bindValue(':token', $token);
        $ins->bindValue(':expira', $expira);
        $ins->execute();

        $link = "http://localhost/teste/usuario/resetar.php?token=" . urlencode($token);

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = getenv('MAIL_HOST');
            $mail->SMTPAuth   = true;
            $mail->Username   = getenv('MAIL_USERNAME');
            $mail->Password   = getenv('MAIL_PASSWORD');
            $mail->SMTPSecure = getenv('MAIL_SECURE');
            $mail->Port       = getenv('MAIL_PORT');

            $mail->setFrom(getenv('MAIL_USERNAME'), 'Suporte PetVitaliz');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Reset de Senha - PetVitaliz';
            $mail->Body = "
                <p>Olá!</p>
                <p>Você solicitou uma redefinição de senha.</p>
                <p>Clique no link abaixo para continuar:</p>
                <p><a href='$link'>$link</a></p>
                <p>Este link expira em 1 hora.</p>
            ";

            $mail->send();

        } catch (Exception $e) {
        }
    }

    echo "
    <div style='
        font-family: Arial;
        padding: 15px;
        background: #e0ffe0;
        border: 1px solid #8ac78a;
        width: fit-content;
        margin: 40px auto;
        font-size: 18px;
        border-radius: 6px;
        text-align: center;
    '>
        $mensagemFinal<br><br>
        <small>Você será redirecionado para o login em instantes...</small>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = 'login.php';
        }, 4000);
    </script>
    ";

    exit();
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset de senha</title>
  <link rel="stylesheet" href="../src/assets/css/reset.css">
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

<form method="POST" style="font-family: Arial; max-width: 350px; padding: 20px; background: #f5f5f5; border-radius: 8px;">
    <h3>Redefinir Senha</h3>
    <p>Digite o e-mail da sua conta:</p>
    <br>

    <input 
        type="email" 
        name="email" 
        placeholder="Seu e-mail..." 
        required 
        style="width:100%; padding:10px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;"
    >

    <button 
        type="submit"
        style="width:100%; padding:10px; background:#1E265D; color:white; border:none; border-radius:5px; cursor:pointer;"
    >
        Enviar link de redefinição
    </button>
</form>



