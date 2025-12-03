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

$pets = [];

try {
    $stmt = $pdo->prepare("SELECT * FROM pet WHERE id_usuario = :id_usuario");
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();
    $pets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p style='color:red;'>Erro ao listar pets: " . $e->getMessage() . "</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/assets/css/listar_pet.css">
    <title>Meus Pets</title>

    <script>
        function confirmDeletion() {
            return confirm("Tem certeza que deseja excluir este pet?");
        }
    </script>
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

<a href="../homeL.php" class="seta">
        <img src="../src/assets/img/seta.png" alt="" height="50px">
</a>

<h2>Meus Pets</h2>

    
    <?php if (count($pets) > 0): ?>
        <table>
            <tr>
                <th>Nome</th>
                <th>Espécie</th>
                <th>Sexo</th>
                <th>Data de Nascimento</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($pets as $pet): ?>
                <tr>
                    <td><?php echo htmlspecialchars($pet['nome']); ?></td>
                    <td><?php echo htmlspecialchars($pet['especie']); ?></td>
                    <td><?php echo htmlspecialchars($pet['sexo']); ?></td>
                    <td><?php echo htmlspecialchars($pet['data_nascimento']); ?></td>
                    <td>
                        <a href="editar_pet.php?id=<?php echo $pet['id_pet']; ?>" class="action-btn">Editar</a>
                        <a href="excluir_pet.php?id=<?php echo $pet['id_pet']; ?>" class="action-btn delete-btn" onclick="return confirmDeletion();">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p class="nenhum">Nenhum pet cadastrado ainda.</p>
    <?php endif; ?>

    <br><br><br><br>
    <p><a href="cadastrar_pet.php" class="action-btn">Cadastrar novo pet</a></p>


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
