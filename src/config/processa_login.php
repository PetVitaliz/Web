<?php


session_start();


try {
    require_once('conexao.php');

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuario WHERE email = :email";
    $query = $pdo->prepare($sql);

    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        $usuario = $query -> fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_logado'] = $usuario;
            header('Location: ../../homeL.php');
            exit;
        } else {
            header('Location: ../../usuario/login.php?erro');
            exit;   
        }

        $_SESSION['usuario_logado'] = $usuario; 
        header('Location: ../../homeL.php'); 
        exit;
    } else {
        $_SESSION['mensagem_erro'] = "EMAIL OU SENHA INVALIDOS";
        header('Location: ../../usuario/login.php?erro');
        exit;
    }
} catch (Exception $e) {
    $_SESSION['mensagem_erro'] = "Erro de conexão: " . $e->getMessage();
    header('Location: ../../usuario/login.php?erro');
    exit;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>