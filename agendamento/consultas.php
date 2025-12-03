<?php

session_start();
require_once('../src/config/conexao.php');

// Checa se usuário está logado e define inicial segura
if (isset($_SESSION['usuario_logado']) && !empty($_SESSION['usuario_logado']['nome'])) {
    $nome_usuario = trim($_SESSION['usuario_logado']['nome']);
    $inicial = strtoupper(mb_substr($nome_usuario, 0, 1));
} else {
    $inicial = null; // não logado
}


$usuario = $_SESSION['usuario_logado'];
$id_usuario = $usuario['id_usuario'];


// BUSCA CONSULTAS DO PACIENTE
$stmt = $pdo->prepare("
    SELECT 
        c.id_consulta,
        p.nome AS nome_pet,
        f.nome AS nome_funcionario,
        f.especialidade,
        c.data_consulta,
        c.hora_inicio,
        c.hora_fim,
        c.status,
        c.observacoes
    FROM consulta c
    INNER JOIN pet p ON c.id_pet = p.id_pet
    INNER JOIN funcionario f ON c.id_funcionario = f.id_funcionario
    WHERE p.id_usuario = :id_usuario
    ORDER BY c.data_consulta DESC, c.hora_inicio ASC
");
$stmt->bindParam(':id_usuario', $id_usuario);
$stmt->execute();
$consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Minhas Consultas</title>
<link rel="stylesheet" href="../src/assets/css/listar_pet.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.container-custom {
    max-width: 900px;
    margin: 120px auto 50px auto;
}
.card {
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 15px;
}
.status-agendada { color:#0d6efd; font-weight:bold; }
.status-concluida { color:#198754; font-weight:bold; }
.status-cancelada { color:#dc3545; font-weight:bold; }

.btn-primary{
    background-color: #2B357D !important;
    border-color: #2B357D !important;
}

.btn-primary:hover {
    background-color: #202862 !important;
}

.user-menu {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.user-menu .dropdown {
    position: absolute;
    top: 55px;
    right: 0;
    background: white;
    width: 180px;
    border-radius: 10px;
    padding: 10px 0;
    display: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    z-index: 100;
}

</style>

</head>
<body>

<header>
    <div class="logo">
      <img src="../src/assets/img/logo.png" height="80px">
    </div>

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
    <div class="user-circle" onclick="toggleDropdown()">
        <?php echo $inicial; ?>
    </div>

    <div class="dropdown" id="userDropdown">
        <a href="../usuario/listar_pet.php">Meus Pets</a>
        <a href="consultas.php">Consultas</a>
        <a href="planos.php">Meu Plano</a>
        <a href="../usuario/logout.php" class="logout">Sair</a>
    </div>
</div>
  </header>

<a href="../homeL.php" class="seta">
    <img src="../src/assets/img/seta.png" height="50px">
</a>

<div class="container container-custom">
    <h2 class="mb-4 text-center">Consultas dos seus Pets</h2>

    <?php if (count($consultas) > 0): ?>
        <?php foreach ($consultas as $consulta): ?>
            <div class="card p-3">
                <h5><strong>Pet:</strong> <?= htmlspecialchars($consulta['nome_pet']) ?></h5>
                <p><strong>Profissional:</strong> <?= htmlspecialchars($consulta['nome_funcionario']) ?></p>
                <p><strong>Serviço:</strong> <?= ucfirst(htmlspecialchars($consulta['especialidade'])) ?></p>
                <p><strong>Data:</strong> <?= date('d/m/Y', strtotime($consulta['data_consulta'])) ?></p>
                <p><strong>Horário:</strong> <?= htmlspecialchars($consulta['hora_inicio']) ?> às <?= htmlspecialchars($consulta['hora_fim']) ?></p>

                <p><strong>Status:</strong> 
                    <span class="status-<?= strtolower($consulta['status']) ?>">
                        <?= ucfirst(htmlspecialchars($consulta['status'])) ?>
                    </span>
                </p>

                <?php if (!empty($consulta['observacoes'])): ?>
                    <p><strong>Observações:</strong> <?= htmlspecialchars($consulta['observacoes']) ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

    <?php else: ?>
        <div class="alert alert-warning text-center">
            Você não possui consultas agendadas.
        </div>
    <?php endif; ?>

    <div class="text-center mt-3">
        <a href="agendamento.php" class="btn btn-primary">Agendar nova consulta</a>
    </div>
</div>

<script>
function toggleDropdown() {
    const drop = document.getElementById("userDropdown");
    drop.style.display = drop.style.display === "block" ? "none" : "block";
}

document.addEventListener("click", function(e) {
    const menu = document.querySelector(".user-menu");
    if (!menu.contains(e.target)) {
        document.getElementById("userDropdown").style.display = "none";
    }
});
</script>

</body>
</html>
