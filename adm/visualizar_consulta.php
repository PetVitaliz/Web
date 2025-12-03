<?php
session_start();
require_once('../src/config/conexao.php');
if (!isset($_SESSION['admin_logado'])) {
  header('Location: login_adm.php');
  exit();
}

$stmt = $pdo->query("SELECT * FROM log_consultas ORDER BY data_hora DESC LIMIT 200");
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Log de Consultas</title>
  <link rel="stylesheet" href=".../css/seu-estilo.css">
</head>
<body>
  <h2>Log de Atividades</h2>
<table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; font-family: Arial;">
  <thead style="background: #f2f2f2; font-weight: bold;">
    <tr>
      <th>Data / Hora</th>
      <th>Ação</th>
      <th>ID da Consulta</th>
      <th>Usuário</th>
      <th>Detalhes</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($logs as $log): ?>
      <tr>
        <td><?= htmlspecialchars($log['data_hora']) ?></td>
        <td><?= htmlspecialchars($log['acao']) ?></td>
        <td>#<?= htmlspecialchars($log['id_consulta']) ?></td>
        <td><?= htmlspecialchars($log['usuario']) ?></td>
        <td><?= nl2br(htmlspecialchars($log['descricao'])) ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

</body>
</html>
