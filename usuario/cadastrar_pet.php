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


$usuario = $_SESSION['usuario_logado'];
$id_usuario = $usuario['id_usuario'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
    $sexo = $_POST['sexo'];
    $data_nascimento = $_POST['data_nascimento'];

    try {
        $sql = "INSERT INTO pet (id_usuario, nome, especie, sexo, data_nascimento)
                VALUES (:id_usuario, :nome, :especie, :sexo, :data_nascimento)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':especie', $especie, PDO::PARAM_STR);
        $stmt->bindParam(':sexo', $sexo, PDO::PARAM_STR);
        $stmt->bindParam(':data_nascimento', $data_nascimento, PDO::PARAM_STR);

        $stmt->execute();

        echo "<p style='color:green;'>Pet cadastrado com sucesso!</p>";

    } catch (PDOException $e) {
        echo "<p style='color:red;'>Erro ao cadastrar pet: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/assets/css/cadastrar_pet.css">
    <title>Cadastrar Pets</title>

</head>
  <header>
    <div class="logo">
      <img src="../src/assets/img/logo.png" alt="" height="80px">
    </div>
    <nav>
      <ul>
        <li><a href="homeL.php">Home</a></li>
        <li><a href="servicosL.php">Nossos Serviços</a></li>
        <li><a href="sobre-nosL.php">Sobre Nós</a></li>
        <li><a href="contatoL.php">Contato</a></li>
        <li><a href="emergenciaL.php">Emergência</a></li>
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

    <h2>Cadastrar Pet</h2>

    <form action="" method="post">

        <label for="nome">Nome do Pet:</label>
        <input type="text" name="nome" id="nome" required>
        <p>

        <label for="especie">Espécie:</label>
        <select name="especie" id="especie" required>
            <option value="cachorro">Cachorro</option>
            <option value="gato">Gato</option>
        </select>
        <p>

        <label for="sexo">Sexo:</label>
        <select name="sexo" id="sexo" required>
            <option value="M">Macho</option>
            <option value="F">Fêmea</option>
        </select>
        <p>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" name="data_nascimento" id="data_nascimento" required>
        <p>

        <button type="submit">Cadastrar</button>
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
