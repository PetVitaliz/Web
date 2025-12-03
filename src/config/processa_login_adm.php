<?php


session_start();


try {
    require_once('conexao.php');

    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM ADMINISTRADOR WHERE ADM_NOME = :nome AND ADM_ATIVO = 1"; 
    $query = $pdo->prepare($sql);

    $query->bindParam(':nome', $nome, PDO::PARAM_STR); 
    $query->execute();

    $admin = $query->fetch(PDO::FETCH_ASSOC);
    if ($admin && password_verify($senha, $admin['ADM_SENHA'])) {
        $_SESSION['admin_logado'] = true;
        $_SESSION['admin_nome'] = $admin['ADM_NOME'];
        header('Location: ../../adm/painel_adm.php');
        exit;
    } else {
        $_SESSION['mensagem_erro'] = "NOME DE USUÁRIO OU SENHA INCORRETO";
        header('Location: ../../adm/login_adm.php?erro');
        exit;
    }
} catch (Exception $e) {
    $_SESSION['mensagem_erro'] = "Erro de conexão: " . $e->getMessage();
    header('Location: ../../adm/login_adm.php?erro');
    exit;

}

?>
