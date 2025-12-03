<?php
session_start();
require_once('../src/config/conexao.php');
require_once('atualizar_consultas.php');



// Verifica se o funcionário está logado
if (!isset($_SESSION['funcionario_logado'])) {
    header('Location: login_fun.php');
    exit();
}

if (!isset($_GET['id'])) {
    echo "Consulta inválida.";
    exit();
}

$id_consulta = $_GET['id'];

// Busca os detalhes da consulta
$stmt = $pdo->prepare("
    SELECT 
        c.id_consulta, 
        c.data_consulta, 
        c.hora_inicio, 
        c.hora_fim, 
        c.status, 
        c.observacoes,
        p.nome AS nome_pet,
        f.nome AS nome_funcionario
    FROM consulta c
    INNER JOIN pet p ON c.id_pet = p.id_pet
    INNER JOIN funcionario f ON c.id_funcionario = f.id_funcionario
    WHERE c.id_consulta = :id
");
$stmt->bindParam(':id', $id_consulta, PDO::PARAM_INT);
$stmt->execute();
$consulta = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$consulta) {
    echo "Consulta não encontrada.";
    exit();
}

// Se o funcionário clicar em "Concluir consulta"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $update = $pdo->prepare("UPDATE consulta SET status = 'finalizado' WHERE id_consulta = :id");
    $update->bindParam(':id', $id_consulta, PDO::PARAM_INT);
    $update->execute();
    header('Location: listar_consulta_fun.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Detalhes da Consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <div class="container bg-white p-4 rounded shadow-sm">
        <h2>Consulta #<?= htmlspecialchars($consulta['id_consulta']); ?></h2>
        <p><strong>Pet:</strong> <?= htmlspecialchars($consulta['nome_pet']); ?></p>
        <p><strong>Funcionário:</strong> <?= htmlspecialchars($consulta['nome_funcionario']); ?></p>
        <p><strong>Data:</strong> <?= htmlspecialchars(date('d/m/Y', strtotime($consulta['data_consulta']))); ?></p>
        <p><strong>Hora Início:</strong> <?= htmlspecialchars($consulta['hora_inicio']); ?></p>
        <p><strong>Hora Fim:</strong> <?= htmlspecialchars($consulta['hora_fim']); ?></p>
        <p><strong>Status:</strong> <?= htmlspecialchars($consulta['status']); ?></p>
        <p><strong>Observações:</strong> <?= nl2br(htmlspecialchars($consulta['observacoes'] ?? 'Nenhuma observação.')); ?></p>

        <?php
    $agora = new DateTime();
    $inicio = new DateTime($consulta['data_consulta'] . ' ' . $consulta['hora_inicio']);
    $fim = new DateTime($consulta['data_consulta'] . ' ' . $consulta['hora_fim']);
    $limiteFinalizacao = (clone $fim)->modify('+5 minutes');

    $mostrarBotao = (
        $consulta['status'] !== 'finalizado' &&
        $agora >= $inicio &&
        $agora <= $limiteFinalizacao
    );
?>

<?php if ($mostrarBotao): ?>
    <form method="POST">
        <button type="submit" class="btn btn-success">Concluir consulta</button>
    </form>

<?php else: ?>
    <p class="text-muted">⚠ Fora da janela de finalização.</p>

    <?php if ($consulta['status'] === 'finalizado'): ?>
        <p class="text-success fw-bold">✅ Consulta já finalizada.</p>
    <?php endif; ?>

<?php endif; ?>


        <a href="listar_consulta_fun.php" class="btn btn-secondary mt-3">← Voltar</a>
    </div>
</body>
</html>
