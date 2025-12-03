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


$stmt = $pdo->prepare("SELECT * FROM pet WHERE id_usuario = :id");
$stmt->bindParam(':id', $id_usuario);
$stmt->execute();
$pets = $stmt->fetchAll(PDO::FETCH_ASSOC);


$data_escolhida = $_POST['data_escolhida'] ?? null;
$horarios_ocupados = [];

if ($data_escolhida) {
    $stmtH = $pdo->prepare("
        SELECT hora_inicio
        FROM consulta
        WHERE data_consulta = :d
    ");
    $stmtH->execute([':d' => $data_escolhida]);
    $horarios_ocupados = array_map(
    fn($h) => substr($h, 0, 5),
    $stmtH->fetchAll(PDO::FETCH_COLUMN)
);

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agendar'])) {

    $servico = $_POST['servico'];
    $id_pet = $_POST['id_pet'];
    $data_consulta = $_POST['data_consulta'];
    $hora_inicio = $_POST['hora_inicio'];
    $observacoes = $_POST['observacoes'] ?? '';

    try {
        $stmt3 = $pdo->prepare("
            SELECT id_funcionario FROM funcionario 
            WHERE especialidade = :servico AND ativo = 1 AND carga > 0
            ORDER BY RAND() LIMIT 1
        ");
        $stmt3->execute([':servico' => $servico]);
        $funcionario = $stmt3->fetch(PDO::FETCH_ASSOC);

        if (!$funcionario) {
            echo "<p style='color:red;'>Nenhum profissional disponível para este serviço.</p>";
        } else {

            $id_funcionario = $funcionario['id_funcionario'];
            $hora_fim = date('H:i', strtotime($hora_inicio) + 3600);

            $stmtVerifica = $pdo->prepare("
                SELECT COUNT(*) FROM consulta
                WHERE id_funcionario = :id
                AND data_consulta = :d
                AND hora_inicio = :h
            ");
            $stmtVerifica->execute([
                ':id' => $id_funcionario,
                ':d' => $data_consulta,
                ':h' => $hora_inicio
            ]);

            if ($stmtVerifica->fetchColumn() > 0) {
                echo "<p style='color:red;'>Horário já ocupado.</p>";
            } else {
                $stmt4 = $pdo->prepare("
                    INSERT INTO consulta
                    (id_funcionario, id_pet, data_consulta, hora_inicio, hora_fim, observacoes, status)
                    VALUES
                    (:f, :p, :d, :hi, :hf, :obs, 'em espera')
                ");
                $stmt4->execute([
                    ':f' => $id_funcionario,
                    ':p' => $id_pet,
                    ':d' => $data_consulta,
                    ':hi' => $hora_inicio,
                    ':hf' => $hora_fim,
                    ':obs' => $observacoes
                ]);

                $pdo->prepare("UPDATE funcionario SET carga = carga - 1 WHERE id_funcionario = $id_funcionario")->execute();

                echo "<script>
setTimeout(function() {
    window.location.href = '../homeL.php';
}, 1000);
</script>
";
            }
        }

    } catch (PDOException $e) {
        echo "<p style='color:red;'>Erro: " . $e->getMessage() . "</p>";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Agendamento</title>
<link rel="stylesheet" href="../src/assets/css/agendamento.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header>
    <div class="logo">
      <img src="../src/assets/img/logo.png" alt="" height="80px">
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

<div class="container mt-4">

<a href="../homeL.php" class="seta">
        <img src="../src/assets/img/seta.png" alt="" height="50px">
</a>

<h2>Agendar Consulta</h2>


<form method="post" class="card p-3 mb-3">
    <h5>Escolha a data</h5>
    <input type="date" name="data_escolhida" class="form-control" required onchange="this.form.submit()" value="<?= $data_escolhida ?>">
</form>

<?php if ($data_escolhida): ?>


<form method="post" class="card p-3">

    <input type="hidden" name="agendar" value="1">
    <input type="hidden" name="data_consulta" value="<?= $data_escolhida ?>">

    <label>Serviço:</label>
    <select class="form-select" name="servico" required>
        <option value="">Selecione...</option>
        <option value="Veterinario">Veterinário</option>
        <option value="Tosador">Tosador</option>
    </select>

    <br>

    <label>Seu Pet:</label>
    <select class="form-select" name="id_pet" required>
        <option value="">Selecione...</option>
        <?php foreach ($pets as $pet): ?>
            <option value="<?= $pet['id_pet'] ?>"><?= htmlspecialchars($pet['nome']) ?></option>
        <?php endforeach; ?>
    </select>

    <br>
        
    <label>Observações:</label>
    <textarea name="observacoes" class="form-control" rows="3"></textarea>

    <br>

    <h5>Horários disponíveis para <?= date("d/m/Y", strtotime($data_escolhida)) ?>:</h5>

    <div style="display:flex; flex-wrap:wrap; gap:10px;">
        <?php
        $inicio = strtotime("08:00");
        $fim = strtotime("18:00");

        while ($inicio <= $fim):
            $hora = date("H:i", $inicio);
            $ocupado = in_array($hora, $horarios_ocupados);
        ?>

        <button type="submit" name="hora_inicio" value="<?= $hora ?>"
        class="btn"
        style="
            padding:10px 18px;
            border-radius:6px;
            <?= $ocupado 
                ? "background:#b5b5b5; color:#666; cursor:not-allowed; border:1px solid #999;" 
                : "background:#2B357D; color:white; cursor:pointer; border:1px;" 
            ?>;"
        <?= $ocupado ? "disabled" : "" ?>>
    <?= $hora ?>
</button>


        <?php
            $inicio = strtotime("+30 minutes", $inicio);
        endwhile;
        ?>
    </div>

    <br>



</form>

<?php endif; ?>


<style>
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


</div>
</body>
</html>


