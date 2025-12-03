<?php
require_once 'conexao.php';
require_once 'limpar_tokens_expirados.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Método inválido.");
}

$token = $_POST['token'];
$senha = $_POST['senha'];
$confirmar = $_POST['confirmar'];

if ($senha !== $confirmar) {
    die("As senhas não coincidem.");
}

// Verifica token
$stmt = $pdo->prepare("SELECT id_usuario FROM reset_senha WHERE token = :token LIMIT 1");
$stmt->bindValue(':token', $token);
$stmt->execute();

if ($stmt->rowCount() == 0) {
    die("Token inválido.");
}

$dados = $stmt->fetch(PDO::FETCH_ASSOC);
$id_usuario = $dados['id_usuario'];

$hash = password_hash($senha, PASSWORD_DEFAULT);

// Atualiza senha
$upd = $pdo->prepare("UPDATE usuario SET senha = :senha WHERE id_usuario = :id");
$upd->bindValue(':senha', $hash);
$upd->bindValue(':id', $id_usuario);
$upd->execute();

// Apaga token
$del = $pdo->prepare("DELETE FROM reset_senha WHERE token = :token");
$del->bindValue(':token', $token);
$del->execute();


echo "
<div style='
    font-family: Arial;
    padding: 30px 25px;
    background: #dfffe1;
    border: 1px solid #7acb8a;
    width: 420px;
    margin: 100px auto;
    font-size: 20px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 4px 25px rgba(0,0,0,0.1);
'>
    <strong style='font-size:22px;'>Senha redefinida com sucesso</strong><br><br>
    Agora você já pode fazer login.<br><br>
    <small>Redirecionando em 3 segundos...</small>
</div>

<script>
    setTimeout(function() {
        window.location.href = '../../usuario/login.php';
    }, 3000);
</script>
";
exit();


echo "Senha alterada com sucesso! Você já pode fazer login";

?>
