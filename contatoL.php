<?php

session_start();
require_once('./src/config/conexao.php');

// Checa se usuário está logado e define inicial segura
if (isset($_SESSION['usuario_logado']) && !empty($_SESSION['usuario_logado']['nome'])) {
    $nome_usuario = trim($_SESSION['usuario_logado']['nome']);
    // pega a primeira letra e força maiúscula, protege contra strings vazias
    $inicial = strtoupper(mb_substr($nome_usuario, 0, 1));
} else {
    $inicial = null; // não logado
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contato</title>
  <link rel="stylesheet" href="./src/assets/css/contato.css">
</head>

<body>
  <div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper"></div>
    </div>
  </div>
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
  </script> 
  
<header>
    <div class="logo">
      <img src="./src/assets/img/logo.png" alt="" height="80px">
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
        <a href="./usuario/listar_pet.php">Meus Pets</a>
        <a href="./agendamento/consultas.php">Consultas</a>
        <a href="./agendamento/planos.php">Meu Plano</a>
        <a href="./usuario/logout.php" class="logout">Sair</a>
    </div>
</div>
  </header>

  <style>
    .user-menu {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* bolinha com inicial */
.user-circle {
    width: 45px;
    height: 45px;
    background: #4F7BF1;
    color: white;
    font-weight: bold;
    font-size: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    user-select: none;
    transition: 0.2s;
}

.user-circle:hover {
    background: #355dcc;
}

.dropdown {
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

.dropdown a {
    display: block;
    padding: 12px 15px;
    text-decoration: none;
    color: #333;
    font-size: 15px;
    transition: 0.2s;
}

.dropdown a:hover {
    background: #f0f0f0;
}

.dropdown .logout {
    color: red;
    font-weight: bold;
}
  </style>

  <section class="hero">
    <div class="colocando-a-pata">
      <img src="./src/assets/img/Group.png" alt="patinha">
    </div>
    <div class="colocar-a-pata">
      <div class="hero-content">
        <h1>Cuidados Compassivos<br> Dedicados ao Bem-Estar do Seu <br> Pet</h1>
        <p>Descubra nossa missão, valores e compromisso inabalável em <br> fornecer cuidados veterinários excepcionais
          para seus queridos <br> companheiros</p>
        <a href="./agendamento/agendamento.php" class="btn">Agendar consulta</a>
        <!-- <div class="paw">🐾</div> -->
      </div>
      <div class="hero-image">
        <img src="./src/assets/img/gatos-e-caes.png" alt="Cachorrinhos e gatinho dormindo">
      </div>
    </div>
  </section>

  <section class="contato">
    <div class="contato-container">
      <div class="contato-texto">
        <h2>Conectando você com o cuidado de seus amados Pets</h2>
        <p>Estamos aqui para responder às suas perguntas e fornecer suporte.</p>
      </div>

      <form class="form-contato" action="./src/config/processa_contatoL.php" method="POST">
        <label for="nome">Seu Nome</label>
        <input type="text" id="nome" name="nome" placeholder="Carlos Robertson">

        <label for="email">Seu E-mail</label>
        <input type="email" id="email" name="email" placeholder="CarlosRobert@mail.com">

        <label for="mensagem">Mensagem</label>
        <textarea id="mensagem" name="mensagem" rows="5" placeholder="Escreva sua mensagem*"></textarea>

        <button type="submit" class="btn-enviar">Enviar mensagem</button>
      </form>
    </div>
  </section>


<!-- começo do rodapé  -->
<footer class="footer">
  <div class="PataGrandeFooder">
    <img src="./src/assets/img/PataGrandeFooter.png" alt="Imagem de fundo de patas" class="paws-background-img">
  </div>


  <div class="footer-logo">
    <img src="./src/assets/img/PataPequenaFooter.png" alt="Logo PetVital" class="footer-logo-icon"> PetVital
  </div>

  <div class="footer-content">

    <div class="footer-links-container">
      <div class="footer-links-column">
        <a href="#">Features</a>
        <a href="#">About Us</a>
        <a href="#">Our Team</a>
      </div>

      <div class="footer-links-column">
        <a href="#">Solutions</a>
        <a href="#">Service</a>
        <a href="#">Testimonials</a>
      </div>

      <div class="footer-links-column">
        <a href="#">Resources</a>
        <a href="#">Pricing</a>
      </div>

      <div class="footer-links-column">
        <a href="#">About</a>
        <a href="#">Industry Insight</a>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="footer-copyright">
      2025 PetVital, All right reserved
    </div>

    <div class="social-icons">
      <img src="./src/assets/img/Instagram.png" alt="Ícone Instagram" class="social-icon-img">
      <img src="./src/assets/img/Behance.png" alt="Ícone Behance" class="social-icon-img">
      <img src="./src/assets/img/Dribbble.png" alt="Ícone dribbble" class="social-icon-img">
      <img src="./src/assets/img/LinkedIn.png" alt="Ícone LinkedIn" class="social-icon-img">
    </div>
  </div>
</footer>

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