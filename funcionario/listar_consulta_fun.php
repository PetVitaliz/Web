<?php
session_start();

require_once('../src/config/conexao.php');
require_once('atualizar_consultas.php');


if (!isset($_SESSION['funcionario_logado'])) {
    header('Location: login_fun.php');
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM funcionario WHERE id_funcionario = :id");
$stmt->bindParam(':id', $funcionario['id_funcionario']);
$stmt->execute();
$funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['bater_ponto'])) {
    $id_funcionario = $funcionario['id_funcionario'];

    $sql = "UPDATE funcionario SET carga = 8 WHERE id_funcionario = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id_funcionario);
    $stmt->execute();

    $_SESSION['funcionario_logado']['carga'] = 8;

    header("Location: home_fun.php");
    exit();
}

$funcionario = $_SESSION['funcionario_logado'];
$id_funcionario = $funcionario['id_funcionario'];

$stmt = $pdo->prepare("
    SELECT 
        c.id_consulta, 
        c.data_consulta, 
        c.hora_inicio, 
        c.hora_fim, 
        c.status, 
        p.nome AS nome_pet
    FROM consulta c
    INNER JOIN pet p ON c.id_pet = p.id_pet
    WHERE c.id_funcionario = :id_funcionario
    ORDER BY c.data_consulta, c.hora_inicio
");
$stmt->bindParam(':id_funcionario', $id_funcionario, PDO::PARAM_INT);
$stmt->execute();
$consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consultas do Funcionário</title>
     <link rel="stylesheet" href="../src/assets/css/listar_pet.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="header">
    <div class="header-left">
        <h3><?php echo htmlspecialchars($funcionario['nome']) . ' ' .  ($funcionario['sobrenome']); ?></h3>
        <span class="cargo"><?php echo htmlspecialchars($funcionario['especialidade']); ?></span>
    </div>

    <div class="header-actions">

        <form method="POST" class="ponto-form" 
              onsubmit="return confirm('Confirmar batida de ponto?');">
            <button type="submit" name="bater_ponto" class="btn ponto">
                ⏱ Bater Ponto
            </button>
        </form>

        <a href="logout_fun.php" onclick="return confirm('Tem certeza que deseja sair?');"
           class="btn sair">
           ↳ Sair
        </a>

    </div>
</header>

<a href="home_fun.php" class="seta">
        <img src="../src/assets/img/seta.png" alt="" height="50px">
</a>

<style>
    .header {
    background: #ffffff;
    border-bottom: 1px solid #e4e7eb;
    padding: 15px 30px;

    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-left h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.header-left .cargo {
    font-size: 13px;
    color: #6b7280;
}

.header-actions {
    display: flex;
    gap: 15px;
    align-items: center;
}

.btn {
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 14px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: 0.2s;
}

.btn.ponto {
    background: #e8f0ff;
    color: #2f4bff;
    border: 1px solid #c9d8ff;
}

.btn.ponto:hover {
    background: #dce6ff;
}

.btn.sair {
    background: #ffe8e8;
    color: #d62828;
    border: 1px solid #ffcccc;
}

.btn.sair:hover {
    background: #ffdede;
}
</style>

<br><br><br>
    <h2>Consultas de <?php echo htmlspecialchars($funcionario['nome']); ?></h2>
    <br>

    <?php if (count($consultas) > 0): ?>
        <table>
            <tr>
                <th>Pet</th>
                <th>Data</th>
                <th>Hora Início</th>
                <th>Hora Fim</th>
                <th>Status</th>
            </tr>
            <?php foreach ($consultas as $consulta): ?>
<tr>    
    <td>
        <a href="detalhes_consulta.php?id=<?php echo $consulta['id_consulta']; ?>">
            <?= htmlspecialchars($consulta['nome_pet']); ?>
        </a>
    </td>
    <td><?= htmlspecialchars(date('d/m/Y', strtotime($consulta['data_consulta']))); ?></td>
    <td><?= htmlspecialchars($consulta['hora_inicio']); ?></td>
    <td><?= htmlspecialchars($consulta['hora_fim']); ?></td>
    <td><?= htmlspecialchars($consulta['status']); ?></td>
</tr>
<?php endforeach; ?>

        </table>
    <?php else: ?>
        <p>Não há consultas agendadas para você no momento.</p>
    <?php endif; ?>


</body>
</html>
