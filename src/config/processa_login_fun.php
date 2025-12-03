<?php
session_start();
require_once('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $registro = trim($_POST['registro']);
    $senha = $_POST['senha'];

    try {
        $sql = "SELECT * FROM funcionario WHERE registro = :registro";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':registro', $registro, PDO::PARAM_STR);
        $stmt->execute();

        // Verifica se o funcionário existe
        if ($stmt->rowCount() > 0) {
            $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifica a senha com password_verify()
            if (password_verify($senha, $funcionario['senha'])) {
                $_SESSION['funcionario_logado'] = $funcionario;
                header('Location: ../../funcionario/home_fun.php');
                exit;
            } else {
                $_SESSION['mensagem_erro'] = "Registro ou senha incorretos!";
                header('Location: ../../funcionario/login_fun.php?erro');
                exit;
            }
        } else {
            $_SESSION['mensagem_erro'] = "Registro ou senha incorretos!";
            header('Location: ../../funcionario/login_fun.php?erro');
            exit;
        }

    } catch (PDOException $e) {
        $_SESSION['mensagem_erro'] = "Erro no banco de dados: " . $e->getMessage();
        header('Location: ../../funcionario/login_fun.php?erro');
        exit;
    }
} else {
    header('Location: ../../funcionario/login_fun.php');
    exit;
}
?>
