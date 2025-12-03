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
    $mail->Host       = getenv('MAIL_HOST');
    $mail->SMTPAuth   = true;
    $mail->Username   = getenv('MAIL_USERNAME');
    $mail->Password   = getenv('MAIL_PASSWORD');
    $mail->SMTPSecure = getenv('MAIL_SECURE');
    $mail->Port       = getenv('MAIL_PORT');

    $mail->setFrom(getenv('MAIL_USERNAME'), 'PetVital');
    $mail->addAddress(getenv('MAIL_USERNAME'), 'PetVital - Contato');

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
    $mailResposta->Host       = getenv('MAILRESPOSTA_HOST');
    $mailResposta->SMTPAuth   = true;
    $mailResposta->Username   = getenv('MAILRESPOSTA_USERNAME');
    $mailResposta->Password   = getenv('MAILRESPOSTA_PASSWORD');
    $mailResposta->SMTPSecure = getenv('MAILRESPOSTA_SECURE');
    $mailResposta->Port       = getenv('MAILRESPOSTA_PORT');

    $mailResposta->setFrom(getenv('MAILRESPOSTA_USERNAME'), 'PetVital');
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
       Em breve você receberá a resposta de nossa equipe<br>
        <small>Redirecionando em 3 segundos...</small>
    </div>
</div>

<link rel='stylesheet' href='../../src/assets/css/alertas.css'>

<script>
setTimeout(function() {
    window.location.href = '../../home.php';
}, 3000);
</script>
";

} catch (Exception $e) {
    echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}
?>
