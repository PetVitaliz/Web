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
  <title>Emergência Pet</title>
  <link rel="stylesheet" href="./src/assets/css/emergencia.css">
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


  <section class="bloco-emergencia-pet">
    <div class="texto-emergencia-pet">
      <h1>Sempre pronto,<br>ajuda de emergência a qualquer hora</h1>
      <p>
        Serviços de emergência confiáveis 24/7 garantindo cuidados imediatos, 
        atenção especializada e apoio compassivo para seus amados pets em momentos críticos.
      </p>
      <div class="botoes-emergencia-pet">
        <a href="./agendamento/agendamento.php">
            <button class="btn-marcar">Agende Consulta</button>
        </a>
      </div>
    </div>

    <div class="imagem-emergencia-pet">
      <img src="./src/assets/img/emergencia1.png" alt="Veterinária com cachorro feliz">
      <div class="decoracao-pata-pet"></div>
    </div>
  </section>

  <section class="secao-ajuda-urgente">
    <div class="imagem-ajuda-urgente">
      <img src="./src/assets/img/nsei.png" alt="Veterinário e tutora com gato preto">
    </div>

    <div class="conteudo-ajuda-urgente">
      <h2>Não se preocupe mais se o seu pet precisar de ajuda urgente.</h2>

      <div class="grade-ajuda-urgente">

        <div class="card-ajuda">
          <span class="numero-ajuda">1</span>
          <h3>Controlar sangramento</h3>
          <p><em>Controle o sangramento:</em> aplique pressão suave nas feridas usando um pano limpo ou bandagem para estancar o sangue. Evite usar um torniquete, a menos que seja absolutamente necessário e apenas por curtos períodos.</p>
        </div>

        <div class="card-ajuda">
          <span class="numero-ajuda">2</span>
          <h3>Realize RCP (se necessário)</h3>
          <p>Se o seu animal de estimação não estiver respirando, faça RCP. Para pequenas animais e filhotes, cubra tanto o nariz quanto a boca com seus lábios e faça 2 sopros de respiração suaves.</p>
        </div>

        <div class="card-ajuda">
          <span class="numero-ajuda">3</span>
          <h3>Lidar com engasgo</h3>
          <p>Verifique a boca do seu animal de estimação e remova qualquer objeto visível. Use pinças para removê-los com cuidado. Se não der certo, realize a manobra de Heimlich aplicando pressão no abdômen do pet.</p>
        </div>

        <div class="card-ajuda">
          <span class="numero-ajuda">4</span>
          <h3>Estabilizar ossos quebrados</h3>
          <p>Mantenha seu animal o mais parado possível. Use uma toalha enrolada como suporte para estabilizar a área afetada, para esperar atendimento especializado.</p>
        </div>

      </div>
    </div>
  </section>

  <section class="emergencia-exata">
  <h2 class="titulo-emergencia">
    Cuidados rápidos, confiáveis e compassivos quando seu <br>
    animal de estimação mais precisa
  </h2>

  <!-- BLOCO 1 -->
  <div class="card-emergencia">
    <div class="card-img">
      <img src="./src/assets/img/24horas.png" alt="Veterinário e cachorro 24h">
    </div>
    <div class="card-texto">
      <h3>Linha de emergência 24/7</h3>
      <p>Fornecendo cuidados de emergência rápidos, confiáveis e compassivos para seus amados animais de estimação em momentos críticos.</p>
      <ul>
        <li>Suporte 24 horas</li>
        <li>Equipe veterinária especializada</li>
        <li>Serviços sob demanda</li>
      </ul>
      <button>Agendar uma visita</button>
    </div>
  </div>

  <!-- BLOCO 2 -->
  <div class="card-emergencia invertido">
    <div class="card-img">
      <img src="./src/assets/img/consulta.png" alt="Consulta veterinária online">
    </div>
    <div class="card-texto">
      <h3>Como funciona</h3>
      <p>Nosso serviço de emergência 24/7 é simples, ágil e eficiente. Veja como você pode obter ajuda imediata para o seu pet:</p>
      <ul>
        <li>Agende ou ligue diretamente</li>
        <li>Conecte-se com um especialista</li>
        <li>Receba orientação ou encaminhamento</li>
      </ul>
      <button>Agendar uma visita</button>
    </div>
  </div>

  <!-- BLOCO 3 -->
  <div class="card-emergencia">
    <div class="card-img">
      <img src="./src/assets/img/cachorro.png" alt="Cachorro com sinais de emergência">
    </div>
    <div class="card-texto">
      <h3>Quando acionar a linha de emergência?</h3>
      <p>Nem sempre é fácil saber quando seu pet precisa de atendimento imediato. Aqui estão alguns sinais de alerta que indicam uma emergência:</p>
      <ul>
        <li>Sangramento excessivo</li>
        <li>Dificuldade para respirar</li>
        <li>Letargia extrema</li>
      </ul>
      <button>Agendar uma visita</button>
    </div>
  </div>
</section>

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
