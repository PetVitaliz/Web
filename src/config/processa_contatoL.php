<?php

require_once '../../src/config/env.php';
require_once '../../usuario/PHPMailer/src/Exception.php';
require_once '../../usuario/PHPMailer/src/PHPMailer.php';
require_once '../../usuario/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Método inválido.");
}

$nome     = trim($_POST['nome']);
$email    = trim($_POST['email']);
$mensagem = trim($_POST['mensagem']);

if (empty($nome) || empty($email) || empty($mensagem)) {
    die("Preencha todos os campos.");
}

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->Host       = $_ENV['MAIL_HOST'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $_ENV['MAIL_USERNAME'];
    $mail->Password   = $_ENV['MAIL_PASSWORD'];
    $mail->SMTPSecure = $_ENV['MAIL_SECURE'];
    $mail->Port       = $_ENV['MAIL_PORT'];

    $mail->setFrom($_ENV['MAIL_USERNAME'], 'PetVital');
    $mail->addAddress($_ENV['MAIL_USERNAME'], 'PetVital - Contato');

    $mail->isHTML(true);
    $mail->Subject = "Novo contato pelo site";
    $mail->Body    = "
        <h2>Novo contato recebido:</h2>
        <strong>Nome:</strong> {$nome}<br>
        <strong>Email:</strong> {$email}<br><br>
        <strong>Mensagem:</strong><br>
        {$mensagem}
    ";

    $mail->send();

    $mailResposta = new PHPMailer(true);

    $mailResposta->isSMTP();
    $mailResposta->Host       = $_ENV['MAIL_HOST'];
    $mailResposta->SMTPAuth   = true;
    $mailResposta->Username   = $_ENV['MAIL_USERNAME'];
    $mailResposta->Password   = $_ENV['MAIL_PASSWORD'];
    $mailResposta->SMTPSecure = $_ENV['MAIL_SECURE'];
    $mailResposta->Port       = $_ENV['MAIL_PORT'];

    $mailResposta->setFrom($_ENV['MAIL_USERNAME'], 'PetVital');
    $mailResposta->addAddress($email, $nome);

    $mailResposta->isHTML(true);
    $mailResposta->Subject = "Recebemos sua mensagem - PetVital";
    $mailResposta->Body = "
        Olá <strong>{$nome}</strong>,<br><br>
        Obrigado por entrar em contato! Sua mensagem foi recebida com sucesso.<br>
        Nossa equipe responderá em breve. 🐾<br><br>
        <strong>Atenciosamente,<br>Equipe PetVital</strong>
    ";

    $mailResposta->send();

    echo "
<div class='alert-container alert-success'>
    <div class='alert-title'>Mensagem enviada com sucesso</div>
    <div class='alert-message'>
       Em breve você receberá a resposta da nossa equipe<br>
        <small>Redirecionando em 3 segundos...</small>
    </div>
</div>

<link rel='stylesheet' href='../../src/assets/css/alertas.css'>

<script>
setTimeout(function() {
    window.location.href = '../../homeL.php';
}, 3000);
</script>
";

} catch (Exception $e) {
    echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}
?>
