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
  <title>Sobre Nos</title>
  <link rel="stylesheet" href="./src/assets/css/sobre-nos.css">
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
    <div class="container-hero">
      <h1 class="titulo-hero">Cuidando de pets, criando<br>vidas felizes e saudáveis</h1>
      <p> Dedicados a fornecer cuidados especializados para pets com amor, 
        confiança e atenção personalizada para cada companheiro peludo </p>

      <div class="buttons">
        <a href="./agendamento/agendamento.php" class="btn primary">Agendar Consulta</a>
      </div>

      <div class="pets">
        <img src="./src/assets/img/sobre-nos1.png" alt="Animais felizes">
      </div>
    </div>
  </section>

  <section class="secao-sobre">
    <div class="conteudo-sobre">
      <div class="texto-sobre">
        <h2>Enraizados no cuidado, movidos pela excelência compassiva</h2>

        <div class="bloco-info">
          <div class="numero">1</div>
          <div>
            <h3>Início humilde</h3>
            <p>Fundada em 2011, nossa clínica começou como uma pequena prática com um grande coração pelos animais.</p>
          </div>
        </div>

        <div class="bloco-info">
          <div class="numero">2</div>
          <div>
            <h3>Crescimento da expertise</h3>
            <p>Ao longo dos anos, expandimos nossa equipe, instalações e serviços para atender às necessidades em evolução dos pets e seus donos.</p>
          </div>
        </div>

        <div class="bloco-info">
          <div class="numero">3</div>
          <div>
            <h3>Cuidado excepcional</h3>
            <p>Fornecer serviços veterinários compassivos e de alta qualidade, adaptados às necessidades únicas de cada pet.</p>
          </div>
        </div>

        <div class="bloco-info">
          <div class="numero">4</div>
          <div>
            <h3>Educação e apoio</h3>
            <p>Capacitar os donos de pets com conhecimento e orientação para uma vida inteira de bem-estar para seus amigos peludos.</p>
          </div>
        </div>
      </div>

      <div class="imagem-sobre">
        <img src="./src/assets/img/veterinaria.png" alt="Veterinária cuidando de um cachorro">
      </div>
    </div>
  </section>

  <section class="area-missao">
    <div class="container-missao">

      <div class="foto-missao">
        <img src="./src/assets/img/dog_de_cobertor.png" alt="Cachorro coberto com toalha após o banho">
      </div>

      <div class="texto-missao">
        <h2>Onde seus pets estão no centro de tudo o que fazemos; nossa missão é fornecer cuidados excepcionais.</h2>
        <p>Da tosa ao bem-estar, cobrimos todos os aspectos das necessidades do seu pet. Nossa equipe se mantém atualizada sobre as últimas novidades em cuidados para pets para oferecer as melhores soluções para você e seus amigos peludos.</p>

        <div class="dados-missao">
          <div>
            <h3>90K</h3>
            <span>Usuários<br>Satisfeitos</span>
          </div>
          <div>
            <h3>150K</h3>
            <span>Download</span>
          </div>
          <div>
            <h3>95%</h3>
            <span>Sucesso em Projetos</span>
          </div>
        </div>
      </div>

    </div>
  </section>

  <section class="container-servicos">
    <h1 class="titulo-servicos">Garantindo Cuidados e<br />Suporte Abrangentes<br />para o Seu Amado Pet</h1>

    <div class="btn-container">
      <div class="btn-text">Garantindo Suporte ao seu Pet</div>
      <button class="btn-saiba-mais">Saiba Mais</button>
    </div>

    <div class="cards">
      <div class="card">
        <div class="card-icon">
          <img src="./src/assets/img/dog-house.png" alt="" class="icon">
        </div>
        <h3 class="card-title">Cuidados Excepcionais Para Seu Pet</h3>
        <p class="card-text">Nossa equipe dedicada garante que cada pet receba o amor e a atenção que merece.</p>
      </div>

      <div class="card">
        <div class="card-icon">
          <img src="./src/assets/img/cat-2.png" alt="" class="icon">
        </div>
        <h3 class="card-title">Conselhos de Especialistas</h3>
        <p class="card-text">Nossa equipe experiente está aqui para ajudar você com dicas, recomendações e soluções adaptadas às necessidades do seu pet.</p>
      </div>

      <div class="card">
        <div class="card-icon">
          <img src="./src/assets/img/Group.png" alt="" class="icon">
        </div>
        <h3 class="card-title">Ambiente Seguro</h3>
        <p class="card-text">A segurança do seu pet é nossa prioridade. Mantemos um espaço limpo, seguro e acolhedor para todos os animais.</p>
      </div>

      <div class="card">
        <div class="card-icon">
          <img src="./src/assets/img/dog-bone-circle.png" alt="" class="icon">
        </div>
        <h3 class="card-title">Serviço Orientado Para A Comunidade</h3>
        <p class="card-text">Como amantes de pet, somos apaixonados por construir uma comunidade de pets e donos felizes.</p>
      </div>
    </div>
  </section>

  <section class="secao-equipe">
    <div class="conteudo-equipe">
      <h2 class="titulo-equipe">Conheça nossa equipe: especialistas compassivos a serviço dos pets</h2>

      <div class="filtros-equipe">
        <button class="botao-filtro ativo">Veterinário(a)</button>
        <button class="botao-filtro">Recepcionista</button>
        <button class="botao-filtro">Gerente da clínica</button>
        <button class="botao-filtro">Tosador(a)</button>
        <button class="botao-filtro">Equipe de hospedagem</button>
      </div>

      <div class="grade-membros">
        <div class="bloco-membro">
          <img src="./src/assets/img/dr1.png" alt="Dr. Jenny Wilson" class="foto-membro" width="300" height="300">
          <div class="info-membro">
            <h3 class="nome-membro">Dr. Jenny Wilson</h3>
            <p class="experiencia-membro">🐾 20+ anos de experiência</p>
          </div>
        </div>
        <div class="bloco-membro">
          <img src="./src/assets/img/dr2.png" alt="Dr. Jane Cooper" class="foto-membro">
          <div class="info-membro">
            <h3 class="nome-membro">Dr. Robert Cooper</h3>
            <p class="experiencia-membro">🐾 20+ anos de experiência</p>
          </div>
        </div>

        <div class="bloco-membro">
          <img src="./src/assets/img/dr4.png" alt="Dr. Jacob Jones" class="foto-membro">
          <div class="info-membro">
            <h3 class="nome-membro">Dr. Jacob Jones</h3>
            <p class="experiencia-membro">🐾 20+ anos de experiência</p>
          </div>
        </div>

        <div class="bloco-membro">
          <img src="./src/assets/img/guy.png" alt="Dr. Guy Hawkins" class="foto-membro">
          <div class="info-membro">
            <h3 class="nome-membro">Dr. Guy Hawkins</h3>
            <p class="experiencia-membro">🐾 20+ anos de experiência</p>
          </div>
        </div>

        <div class="bloco-membro">
          <img src="./src/assets/img/dr3.png" alt="Dr. Kristin Watson" class="foto-membro">
          <div class="info-membro">
            <h3 class="nome-membro">Dr. Kristin Watson</h3>
            <p class="experiencia-membro">🐾 20+ anos de experiência</p>
          </div>
        </div>

        <div class="bloco-membro">
          <img src="./src/assets/img/jane.png" alt="Dr. Theresa Webb" class="foto-membro">
          <div class="info-membro">
            <h3 class="nome-membro">Dr. Theresa Webb</h3>
            <p class="experiencia-membro">🐾 20+ anos de experiência</p>
          </div>
        </div>

        <div class="bloco-membro">
          <img src="./src/assets/img/selena.png" alt="Dr. Selena Grey" class="foto-membro">
          <div class="info-membro">
            <h3 class="nome-membro">Dr. Selena Grey</h3>
            <p class="experiencia-membro">🐾 20+ anos de experiência</p>
          </div>
        </div>

        <div class="bloco-membro">
          <img src="./src/assets/img/ka.png" alt="Dr. Kathryn Murphy" class="foto-membro">
          <div class="info-membro">
            <h3 class="nome-membro">Dr. Kathryn Murphy</h3>
            <p class="experiencia-membro">🐾 20+ anos de experiência</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="secao-valores">
  <h2 class="titulo-valores">
    Cuidado compassivo para cada pata, todos os dias
  </h2>

  <div class="container-valores">
    <div class="linha-valores">
      <div class="card-valor">
        <div class="icone-valor">
          <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" alt="Compaixão" />
        </div>
        <h3 class="titulo-card-valor">Compaixão</h3>
        <p class="texto-card-valor">
          Tratamos cada pet com bondade e empatia, entendendo suas necessidades e emoções únicas.
        </p>
      </div>

      <div class="card-valor">
        <div class="icone-valor">
          <img src="https://cdn-icons-png.flaticon.com/512/942/942748.png" alt="Integridade" />
        </div>
        <h3 class="titulo-card-valor">Integridade</h3>
        <p class="texto-card-valor">
          Estamos comprometidos com a honestidade, transparência e práticas éticas em todos os aspectos do nosso cuidado.
        </p>
      </div>
    </div>

    <div class="linha-valores">
      <div class="card-valor">
        <div class="icone-valor">
          <img src="https://cdn-icons-png.flaticon.com/512/942/942833.png" alt="Excelência" />
        </div>
        <h3 class="titulo-card-valor">Excelência</h3>
        <p class="texto-card-valor">
          Nos esforçamos para fornecer o mais alto padrão de atendimento veterinário por meio de aprendizado contínuo e dedicação.
        </p>
      </div>

      <div class="card-valor">
        <div class="icone-valor">
          <img src="https://cdn-icons-png.flaticon.com/512/942/942748.png" alt="Colaboração" />
        </div>
        <h3 class="titulo-card-valor">Colaboração</h3>
        <p class="texto-card-valor">
          Trabalhamos em estreita colaboração com os donos de pets e uma equipe de profissionais qualificados para garantir os melhores resultados para cada pet.
        </p>
      </div>
    </div>
  </div>
</section>


<section class="secao-instalacoes">
  <div class="cabecalho-instalacoes">
    <h2 class="titulo-instalacoes">As melhores instalações estão aqui</h2>
    <div class="campo-pesquisa">
      <input type="text" placeholder="Pesquisar instalações aqui" />
      <button class="botao-voz" aria-label="Pesquisar por voz">
        <span class="icone-microfone">🎤</span>
      </button>
    </div>
  </div>

  <div class="galeria-instalacoes">
    <div class="cartao-instalacao">
      <img src="./src/assets/img/tosa.png" alt="Área de tosa" />
      <span class="rotulo-instalacao">Área de tosa</span>
    </div>

    <div class="cartao-instalacao">
      <img src="./src/assets/img/hospedagem.png" alt="Instalações de hospedagem" />
      <span class="rotulo-instalacao">Instalações de hospedagem</span>
    </div>

    <div class="cartao-instalacao">
      <img src="./src/assets/img/spa.png" alt="Spa para pets" />
      <span class="rotulo-instalacao">Spa para pets</span>
    </div>

    <div class="cartao-instalacao">
      <img src="./src/assets/img/recreação.png" alt="Área de recreação" />
      <span class="rotulo-instalacao">Área de recreação</span>
    </div>
  </div>

  <p class="texto-instalacoes">
    Por favor, selecione a instalação que você procura e necessita. Nós sempre oferecemos o melhor
    para a felicidade e o conforto de você e do seu pet.
  </p>

  <div class="controles-instalacoes">
    <button class="botao-controle anterior" aria-label="Anterior">←</button>
    <button class="botao-controle proximo" aria-label="Próximo">→</button>
  </div>
</section>

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
