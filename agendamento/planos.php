<?php
session_start();
require_once('../src/config/conexao.php');

// Checa se usuário está logado e define inicial segura
if (isset($_SESSION['usuario_logado']) && !empty($_SESSION['usuario_logado']['nome'])) {
    $nome_usuario = trim($_SESSION['usuario_logado']['nome']);
    // pega a primeira letra e força maiúscula, protege contra strings vazias
    $inicial = strtoupper(mb_substr($nome_usuario, 0, 1));
} else {
    $inicial = null; // não logado
}

$id_usuario = $_SESSION['usuario_logado']['id_usuario']; 

// Busca o plano MAIS RECENTE que o usuário assinou
$sql = "SELECT p.*, a.data_assinatura, a.id_assinatura 
        FROM assinaturas a 
        JOIN produtos p ON a.id_produto = p.id_produto 
        WHERE a.id_usuario = :id_user 
        ORDER BY a.id_assinatura DESC LIMIT 1";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_user', $id_usuario);
$stmt->execute();
$meu_plano = $stmt->fetch(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Plano - PetVitaliz</title>
    <link rel="stylesheet" href="../src/assets/css/home_logada.css">
    <style>
        .container-meu-plano { padding: 50px; text-align: center; }
        .card-ativo { 
            border: 2px solid #4CAF50; 
            background: white; 
            max-width: 500px; 
            margin: 0 auto; 
            padding: 30px; 
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05); /* Sombra para destacar */
        }
        .badge-ativo {
            background: #4CAF50; color: white; padding: 5px 10px; border-radius: 20px; font-size: 14px;
        }
        /* NOVO CSS para o botão de cancelar */
        .btn-cancelar {
            display: inline-block;
            margin-top: 20px;
            background: #ff4d4d; /* Cor vermelha de alerta */
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s;
        }
        .btn-cancelar:hover {
            background: #e63939;
        }
        h2 {
            font-size: 30px;
        }
    </style>
</head>
<body>

<header>
    <div class="logo"><img src="../src/assets/img/logo.png" alt="" height="80px"></div>
    <nav>
      <ul>
        <li><a href="../homeL.php">Home</a></li>
        <li><a href="../pagina_serviços/">Nossos Serviços</a></li>
        <li><a href="../pagina_sobre_nos/">Sobre Nós</a></li>
        <li><a href="../pagina_contato/">Contato</a></li>
        <li><a href="../pagina_emergencia/">Emergência</a></li>
      </ul>
    </nav>
    <div class="user-menu">
        <div class="user-circle" onclick="toggleDropdown()"><?= $inicial ?></div>
        <div class="dropdown" id="userDropdown">
            <a href="../usuario/listar_pet.php">Meus Pets</a>
            <a href="consultas.php">Consultas</a>
            <a href="planos.php">Meu Plano</a>
            <a href="../usuario/logout.php" class="logout">Sair</a>
        </div>
    </div>
</header>

<div class="container-meu-plano">
    <h2>Meu Plano Atual</h2>
    <br><br>

    <?php if ($meu_plano): ?>
        <div class="card-ativo">
            <span class="badge-ativo">ATIVO</span>
            <h2><?= htmlspecialchars($meu_plano['nome']) ?></h2>
            <h1>R$ <?= number_format($meu_plano['preco'], 2, ',', '.') ?> <small>/mês</small></h1>
            <p><?= htmlspecialchars($meu_plano['descricao']) ?></p>
            <p><strong>Assinado em:</strong> <?= date('d/m/Y', strtotime($meu_plano['data_assinatura'])) ?></p>
            
            <hr>
            <h3>Benefícios Inclusos:</h3>
            <ul style="list-style: none; padding: 0;">
                <?php 
                $beneficios = explode("\n", $meu_plano['beneficios'] ?? '');
                foreach($beneficios as $b) {
                    if(trim($b)) echo "<li style='padding:5px;'>✅ " . htmlspecialchars($b) . "</li>";
                }
                ?>
            </ul>
            
            <a href="cancelar_plano.php?id=<?= $meu_plano['id_assinatura'] ?>" class="btn-cancelar" onclick="return confirm('Tem certeza que deseja cancelar seu plano? Esta ação não pode ser desfeita.')">
                Cancelar Plano
            </a>
            </div>
    <?php else: ?>
        <div class="card-ativo" style="border-color: #ccc;">
            <h3>Você ainda não possui um plano ativo.</h3>
            <p>Garanta o bem-estar do seu pet agora mesmo!</p>
            <a href="../homeL.php" class="btn-cancelar" style="background: #2B357D;">Ver Planos</a>
        </div>
    <?php endif; ?>

</div>

<script>
function toggleDropdown() {
    const drop = document.getElementById("userDropdown");
    drop.style.display = drop.style.display === "block" ? "none" : "block";
}

document.addEventListener("click", function(e) {
    const userMenu = document.querySelector(".user-menu");
    if (!userMenu.contains(e.target)) {
        document.getElementById("userDropdown").style.display = "none";
    }
});
</script>

</body>
</html>