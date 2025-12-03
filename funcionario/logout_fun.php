<?php
session_start(); // Inicia a sessão (necessário para destruí-la)

// Remove todas as variáveis de sessão
session_unset();

// Destroi a sessão
session_destroy();

// Redireciona para o login
header('Location: login_fun.php');
exit;