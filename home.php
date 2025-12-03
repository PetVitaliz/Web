<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PetVitaliz</title>
  <link rel="stylesheet" href="./src/assets/css/home.css"> <!-- Linkando o arquivo CSS -->
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

<!-- inicio cabeçalho -->
  <header>
    <div class="logo">
      <img src="./src/assets/img/logo.png" alt="" height="80px">
    </div>
    <nav>
      <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="servicos.html">Nossos Serviços</a></li>
        <li><a href="sobre-nos.html">Sobre Nós</a></li>
        <li><a href="contato.html">Contato</a></li>
        <li><a href="emergencia.html">Emergência</a></li>
      </ul>
    </nav>
    <div class="auth">
    <a href="./usuario/cadastro.php">
        <button class="botao1">Registre-se</button>
    </a>

    <div class="dropdown-login">
        <button class="botao2" onclick="toggleLoginMenu()">Login ▾</button>

        <div class="dropdown-login-menu" id="loginMenu">
            <a href="./usuario/login.php">Login Paciente</a>
            <a href="./funcionario/login_fun.php">Login Funcionário</a>
            <a href="./adm/login_adm.php">Login ADM</a>
        </div>
    </div>
</div>

    
  </header>
  <!-- fim do cabeçalho  -->

  <!-- inicio do home -->

  <section class="hero">
    <div class="text">
      <h2>Garantindo cuidado <br> e apoio para seus <br> amados pets</h2>
      <a href="login.php">
        <button class="agendar">Agendar Consulta</button>
      </a>
      <p>Nossa clínica veterinária oferece atendimento <br> abrangente e compassivo para seu pet.</p>
    </div>

    <div class="pata">
      <img src="./src/assets/img/pata.png" alt="patinha">
    </div>

    <div class="hero-images">
      <img src="./src/assets/img/beautiful-young-girl-holding-her-adorable-cat-and-2023-11-27-04-56-52-utc 3.png"
        alt="Imagem de cachorro" />
      <img src="./src/assets/img/funny-jack-russell-dog-running-at-sunset-in-nature-2024-11-02-23-48-09-utc 3.png"
        alt="Imagem de cães brincando" />
      <img src="./src/assets/img/hispanic-woman-and-puppy-cocker-spaniel-dog-outdoo-2024-11-03-00-07-29-utc 3.png"
        alt="Imagem de cachorro fofo" />
      <img src="./src/assets/img/casual-cheerful-man-with-british-shorthair-cat-at-2024-11-17-11-12-00-utc 4.png"
        alt="Imagem de cachorro com coleira" />
    </div>
    <!-- fim do home -->

    <!-- começo da section garantindo cuidados -->
  </section>
  <section class="container">
    <h1>Garantindo Cuidados e<br />Suporte Abrangentes<br />para o Seu Amado Pet</h1>

    <div class="btn-container">
      <div class="btn-text">Garantindo Suporte ao seu Pet</div>
      <a href="servicos.html">
        <button class="btn-saiba-mais">Saiba Mais</button>
      </a>
    </div>

    <div class="cards">
      <div class="card">
        <div class="card-icon" aria-hidden="true">
          <!-- ícone cachorro -->
          <!-- <svg class="icon" viewBox="0 0 24 24" >
            <path d="M7 10c-2 0-3 2-3 4v2h2v-2c0-1 .5-2 1-2s1 1 1 2v2h2v-2c0-2-1-4-3-4zM17 10c2 0 3 2 3 4v2h-2v-2c0-1-.5-2-1-2s-1 1-1 2v2h-2v-2c0-2 1-4 3-4zM12 2c-2 0-3 3-3 3s1 2 3 2 3-2 3-2-1-3-3-3z"/>
          </svg> -->
          <img src="./src/assets/img/dog-house.png" alt="" class="icon">
        </div>
        <h3 class="card-title">Cuidados Excepcionais Para Seu Pet</h3>
        <p class="card-text">Nossa equipe dedicada garante que cada pet receba o amor e a atenção que merece.</p>
      </div>

      <div class="card">
        <div class="card-icon" aria-hidden="true">
          <!-- ícone gato -->
          <!-- <svg class="icon" viewBox="0 0 24 24" >
            <path d="M12 2c-1.5 0-3 1.5-3 3s.5 2 3 2 3-1 3-2-1.5-3-3-3zm3 7h-6l-1 5h8l-1-5zm-8 8v-2h10v2H7z"/>
          </svg> -->
          <img src="./src/assets/img/cat-2.png" alt="" class="icon">

        </div>
        <h3 class="card-title">Conselhos de Especialistas</h3>
        <p class="card-text">Nossa equipe experiente está aqui para ajudar você com dicas, recomendações e soluções
          adaptadas às necessidades do seu pet.</p>
      </div>

      <div class="card">
        <div class="card-icon" aria-hidden="true">
          <!-- ícone lupa -->
          <!-- <svg class="icon" viewBox="0 0 24 24" >
            <path d="M10 2a8 8 0 1 1 0 16 8 8 0 0 1 0-16zm6.5 14l4 4-1.5 1.5-4-4V16h1.5z"/>
          </svg> -->
          <img src="./src/assets/img/Group.png" alt="" class="icon">
        </div>
        <h3 class="card-title">Ambiente Seguro</h3>
        <p class="card-text">A segurança do seu pet é nossa prioridade. Mantemos um espaço limpo, seguro e acolhedor
          para todos os animais.</p>
      </div>

      <div class="card">
        <div class="card-icon" aria-hidden="true">
          <!-- ícone osso -->
          <!-- <svg class="icon" viewBox="0 0 24 24" >
            <path d="M7 3a2 2 0 0 0-2 2c0 .5.2 1 .5 1.3L7 8a2 2 0 0 0 2 2c.5 0 1-.2 1.3-.5L12 7l1.7 2.5c.3.3.8.5 1.3.5a2 2 0 0 0 2-2l1.5-1.7c.3-.3.5-.8.5-1.3a2 2 0 0 0-2-2c-.5 0-1 .2-1.3.5L15 5l-1.7-2.5C13 2.2 12.5 2 12 2a2 2 0 0 0-2 1z"/>
          </svg> -->
          <img src="./src/assets/img/dog-bone-circle.png" alt="" class="icon">
        </div>
        <h3 class="card-title">Serviço Orientado Para A Comunidade</h3>
        <p class="card-text">Como amantes de pet, somos apaixonados por construir uma comunidade de pets e donos
          felizes.</p>
      </div>
    </div>
  </section>
  <!-- fim da section garantindo cuidados -->

  <!-- INICIO CARROSEL ___________________________________________________________________________________________________________________ -->

  <section class="carrosel">
    <div class="container-servicos">
      <div class="card-servicos">
        <div class="coluna-imagem">
          <div class="bloco-destaque" id="bloco-destaque">
            <img id="imagem-display" src="./src/assets/img/suprimento.png" alt="">
            <div class="overlay-texto">
              <a href="servicos.html" class="titulo-destaque" id="titulo-destaque">
    Suprimento de Pet <span class="arrow">→</span>
</a>

            </div>

          </div>
        </div>

        <div class="coluna-servicos">
          <h2 class="titulo-principal">Nossos serviços</h2>

          <div class="lista-servicos">

            <button class="item-servico ativo" data-titulo="Suprimento de Pet"
              data-imagem-src="./src/assets/img/suprimento.png">
              <div class="icone-e-titulo">
                <img
                  src="./src/assets/img/suprimento_icone.png"
                  alt="Ícone Suprimento" class="icone-servico">
                <span class="titulo-servico">Suprimento de Pet</span>
              </div>
              <div class="tags-servico">
                <span class="tag">Brinquedos</span>
                <span class="tag">Acessórios</span>
              </div>
            </button>

            <button class="item-servico" data-titulo="Serviços de Higiene"
              data-imagem-src="./src/assets/img/higiene.png">
              <div class="icone-e-titulo">
                <img src="./src/assets/img/higiene_icone.png" alt="Ícone Higiene" class="icone-servico">
                <span class="titulo-servico">Serviços de Higiene</span>
              </div>
              <div class="tags-servico">
                <span class="tag">Corte de Unhas</span>
                <span class="tag">Limpeza de Ouvido</span>
              </div>
            </button>

            <button class="item-servico" data-titulo="Suporte Veterinário"
              data-imagem-src="./src/assets/img/vet.png">
              <div class="icone-e-titulo">
                <img src="./src/assets/img/vet_icone.png" alt="Ícone Vet" class="icone-servico">
                <span class="titulo-servico">Suporte Veterinário</span>
              </div>
              <div class="tags-servico">
                <span class="tag">Check-Ups</span>
                <span class="tag">Vacinação</span>
              </div>
            </button>

            <button class="item-servico" data-titulo="Assistência com Adoção"
              data-imagem-src="./src/assets/img/adocao.png">
              <div class="icone-e-titulo">
                <img src="./src/assets/img/adocao_icone.png" alt="Ícone Adoção" class="icone-servico">
                <span class="titulo-servico">Assistência com Adoção</span>
              </div>
              <div class="tags-servico">
                <span class="tag">Abrigos locais</span>
                <span class="tag">Pet Perfeito</span>
              </div>
            </button>

            <button class="item-servico" data-titulo="Hospedagem & Creche Para Pets"
              data-imagem-src="./src/assets/img/hospe.png">
              <div class="icone-e-titulo">
                <img src="./src/assets/img/hospe_icone.png" alt="Ícone Hospedagem" class="icone-servico">
                <span class="titulo-servico">Hospedagem & Creche Para Pets</span>
              </div>
              <div class="tags-servico">
                <span class="tag">Hora de Brincar</span>
                <span class="tag">Alimentação</span>
              </div>
            </button>

          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="./src/assets/js/home.js"></script>

  
  <!-- Parte dos produtos -->
    <section class="pricing-section">
    <div class="TextoPlanos">
        <h1 class="textoPlanos">Mantenha seus Pets felizes e saudáveis.</h1>
    </div>
    <p class="fraseplanos">Inscreva-se hoje mesmo para receber cuidados especializados.</p>

    <?php
    // Inclui a conexão (que cria a variável $pdo)
    require_once './src/config/conexao.php';

    try {
        // Seleciona os produtos usando PDO e o nome da coluna
        $sql = "SELECT * FROM produtos ORDER BY id_produto ASC LIMIT 4";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $produtos_home = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<p style='text-align:center; color:red'>Erro ao carregar planos.</p>";
        $produtos_home = [];
    }
    ?>

    <div class="pricing-container">
        
        <?php if (count($produtos_home) > 0): ?>
            <?php foreach ($produtos_home as $p): ?>
                
                <div class="card-plano2">
                    
                    <div class="card-header">
                        <h3><?= htmlspecialchars($p['nome']) ?></h3>
                        <h2>R$<?= number_format($p['preco'], 2, ',', '.') ?> <span>/Mês</span></h2>
                        <p class="fraseplanos"><?= htmlspecialchars($p['descricao']) ?></p>
                        <a href="./usuario/login.php">
                          <button>Inscreva-se agora</button>
                        </a>
                    </div>
                    
                    <div class="card-divider"></div>

                    <ul class="features">
                    <?php
                        // 1. Divide a string de benefícios em um array usando a quebra de linha (\n)
                        $beneficios_array = explode("\n", $p['beneficios'] ?? '');

                        // 2. Itera sobre o array e cria um <li> para cada benefício
                        foreach ($beneficios_array as $beneficio) {
                            $beneficio_trim = trim($beneficio); // Remove espaços em branco
                            if (!empty($beneficio_trim)) {
                                echo '<li>' . htmlspecialchars($beneficio_trim) . '</li>';
                            }
                        }
                    ?>
                    </ul>
                </div>
                <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center; width:100%;">Nenhum plano cadastrado no momento.</p>
        <?php endif; ?>

    </div>
</section>
<style>
    .pricing-container {
      position: relative;
      left: 220px;
    }
  </style>
  <script src="script.js"></script>
<br><br>
  <!-- PARTE DOS DOUTORES VETERINÁRIOS -->
  <div class="dr">
    <section class="team-section">
      <div class="conheça">
        <h1>Conheça nossa equipe: Especialistas compassivos dedicados aos animais de estimação</h1>
      </div>

      <div class="team-container">
        <div class="card">
          <img src="./src/assets/img/dr1.png" alt="Dr. 1">
          <div class="card-info">
            <h3>Dr. Jenny Wilson</h3>
            <p>🐾 20+ Years Experience</p>
          </div>
        </div>

        <div class="card">
          <img src="./src/assets/img/dr2.png" alt="Dr. 2">
          <div class="card-info">
            <h3>Dr. Robert Cooper</h3>
            <p>🐾 20+ Years Experience</p>
          </div>
        </div>

        <div class="card">
          <img src="./src/assets/img/dr3.png" alt="Dr. 3">
          <div class="card-info">
            <h3>Dr. Kristin Watson</h3>
            <p>🐾 20+ Years Experience</p>
          </div>
        </div>

        <div class="card">
          <img src="./src/assets/img/dr4.png" alt="Dr. 4">
          <div class="card-info">
            <h3>Dr. Jacob Jones</h3>
            <p>🐾 20+ Years Experience</p>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- PARTE 6, COMENTARIO DOS CLIENTES -->
  <section class="testimonials">
    <h2>O que nossos clientes dizem</h2>

    <div class="testimonials-grid">
      <div class="testimonial-card">
        <span class="badge">Anonymous</span>
        <p>
          Até o momento, este pet shop tem se mostrado o melhor da região em termos
          de serviços especializados e confiáveis para donos de animais. Sua equipe
          trabalha com genuíno cuidado e paixão.
        </p>
      </div>

      <div class="testimonial-card">
        <span class="badge">Anonymous</span>
        <p>
          Até o momento, este pet shop tem se mostrado o melhor da região em termos
          de serviços especializados e confiáveis para donos de animais. Sua equipe
          trabalha com genuíno cuidado e paixão.
        </p>
      </div>

      <div class="testimonial-card">
        <span class="badge">Anonymous</span>
        <p>
          Até o momento, este pet shop tem se mostrado o melhor da região em termos
          de serviços especializados e confiáveis para donos de animais. Sua equipe
          trabalha com genuíno cuidado e paixão.
        </p>
      </div>

      <div class="testimonial-card">
        <span class="badge">Anonymous</span>
        <p>
          Até o momento, este pet shop tem se mostrado o melhor da região em termos
          de serviços especializados e confiáveis para donos de animais. Sua equipe
          trabalha com genuíno cuidado e paixão.
        </p>
      </div>
    </div>
  </section>

  <div class="envoltura-suprema">
    <div class="recipiente-conteudo">
      <h1 class="titulo-principal-proeminente">
        A Felicidade do seu pet, Nossa prioridade. Tudo o que seu pet precisa, em um só lugar.
      </h1>
      <p class="paragrafo-secundario-descritivo">
        Entre em contato sempre que quiser e precisar. Tudo para a sua felicidade e a do seu pet.
      </p>
      <a href="#" class="acao-botão-primario">
        Comece
      </a>
    </div>
  </div>

<script>
function toggleLoginMenu() {
    const menu = document.getElementById("loginMenu");
    const isOpen = menu.style.display === "block";

    // Fecha todos primeiro
    document.querySelectorAll(".dropdown-login-menu").forEach(m => m.style.display = "none");

    // Abre o dropdown atual
    menu.style.display = isOpen ? "none" : "block";
}

// Fecha ao clicar fora
document.addEventListener("click", function(e) {
    const menu = document.getElementById("loginMenu");
    if (!e.target.closest(".dropdown-login")) {
        menu.style.display = "none";
    }
});
</script>


</body>

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

</html>