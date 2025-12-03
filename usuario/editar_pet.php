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


if (!isset($_GET['id'])) {
    echo "<p style='color:red;'>ID do pet não informado.</p>";
    exit();
}

$id_pet = $_GET['id'];


try {
    $stmt_pet = $pdo->prepare("SELECT * FROM pet WHERE id_pet = :id_pet");
    $stmt_pet->bindParam(':id_pet', $id_pet, PDO::PARAM_INT);
    $stmt_pet->execute();
    $pet = $stmt_pet->fetch(PDO::FETCH_ASSOC);

    if (!$pet) {
        echo "<p style='color:red;'>Pet não encontrado.</p>";
        exit();
    }
} catch (PDOException $e) {
    echo "<p style='color:red;'>Erro ao buscar pet: " . $e->getMessage() . "</p>";
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
    $sexo = $_POST['sexo'];
    $data_nascimento = $_POST['data_nascimento'];

    try {
        $stmt_update = $pdo->prepare("
            UPDATE pet 
            SET nome = :nome, especie = :especie, sexo = :sexo, data_nascimento = :data_nascimento
            WHERE id_pet = :id_pet
        ");
        $stmt_update->bindParam(':nome', $nome);
        $stmt_update->bindParam(':especie', $especie);
        $stmt_update->bindParam(':sexo', $sexo);
        $stmt_update->bindParam(':data_nascimento', $data_nascimento);
        $stmt_update->bindParam(':id_pet', $id_pet, PDO::PARAM_INT);
        $stmt_update->execute();

        echo "<p style='color:green;'>Pet atualizado com sucesso!</p>";

        $pet['nome'] = $nome;
        $pet['especie'] = $especie;
        $pet['sexo'] = $sexo;
        $pet['data_nascimento'] = $data_nascimento;

    } catch (PDOException $e) {
        echo "<p style='color:red;'>Erro ao atualizar pet: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/assets/css/cadastrar_pet.css">
    <title>Editar Pet</title>

</head>
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
        <a href="listar_pet.php">Meus Pets</a>
        <a href="../agendamento/consultas.php">Consultas</a>
        <a href="../agendamento/planos.php">Meu Plano</a>
        <a href="logout.php" class="logout">Sair</a>
    </div>
</div>
  </header>

<body>

<a href="listar_pet.php" class="seta">
        <img src="../src/assets/img/seta.png" alt="" height="50px">
</a>

    <h2>Editar Pet</h2>

    <form action="" method="post">

        <label for="nome">Nome do Pet:</label>
        <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($pet['nome']); ?>" required>
        <p>

        <label for="especie">Espécie:</label>
        <select name="especie" id="especie" required>
            <option value="cachorro" <?= $pet['especie'] == 'cachorro' ? 'selected' : ''; ?>>Cachorro</option>
            <option value="gato" <?= $pet['especie'] == 'gato' ? 'selected' : ''; ?>>Gato</option>
        </select>
        <p>

        <label for="sexo">Sexo:</label>
        <select name="sexo" id="sexo" required>
            <option value="M" <?= $pet['sexo'] == 'M' ? 'selected' : ''; ?>>Macho</option>
            <option value="F" <?= $pet['sexo'] == 'F' ? 'selected' : ''; ?>>Fêmea</option>
        </select>
        <p>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" name="data_nascimento" id="data_nascimento" value="<?= htmlspecialchars($pet['data_nascimento']); ?>" required>
        <p>

        <button type="submit">Salvar Alterações</button>
    </form>




    

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
