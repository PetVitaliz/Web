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
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nossos Serviços</title>
  <link rel="stylesheet" href="./src/assets/css/servicos.css">
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

  <section class="hero-servicos">
    <div class="hero-servicos-conteudo">
      <h1>Cuidados abrangentes para pets adaptados a cada necessidade</h1>
      <br><br><br><br>
      <p>
        Descubra serviços especializados projetados para nutrir, curar e garantir a felicidade de seus amados pet
      </p>
      <a href="./agendamento/agendamento.php" class="btn-servicos">Agendar Consulta</a>
    </div>

    <div class="hero-servicos-imagem">
      <img src="./src/assets/img/cat-e-dog.png" alt="Cachorro e gato felizes">
    </div>
    <div class="icone-pata">
        <img class="foto-pata" src="./src/assets/img/pata.png" alt="">
      </div>
  </section>

  <section class="hero">
    <div class="hero-content">
      <h1>A felicidade do seu pet,<br>nossa maior prioridade sempre!</h1>
      <p>Descubra cuidados personalizados e serviços especializados projetados para manter seus amigos peludos
        saudáveis, felizes e cheios de alegria.</p>

      <div class="cards">
        <div class="card">
          <h3>Serviços abrangentes</h3>
          <p>Desde cuidados pessoais e treinamento até exames médicos e creches, oferecemos soluções completas para o
            bem-estar do seu animal de estimação.</p>
        </div>

        <div class="card">
          <h3>Especialistas Certificados</h3>
        </div>

        <div class="card">
          <h3>Instalações de última geração</h3>
        </div>

        <div class="card">
          <h3>Confiável por donos de pet</h3>
        </div>
      </div>
    </div>

    <div class="hero-image">
      <img src="./src/assets/img/cat.png" alt="Gato feliz no gramado">
    </div>
  </section>

    <section class="carrosel">
    <div class="container-servicos">
      <div class="card-servicos">
        <div class="coluna-imagem">
          <div class="bloco-destaque" id="bloco-destaque">
            <img id="imagem-display" src="./src/assets/img/suprimento.png" alt="">
            <div class="overlay-texto">
              <p class="titulo-destaque" id="titulo-destaque">Suprimento de Pet <span class="arrow">→</span>
              </p>
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
  <script src="./src/assets/js/servicos.js"></script>

  <section class="secao-tosa">
    <div class="texto-tosa">
      <div class="controles">
        <button class="seta">&#8592;</button>
        <button class="seta">&#8594;</button>
      </div>

      <h2>Mime seu pet com nossos<br>Serviços de tosa especializados</h2>

      <div class="etiquetas">
        <span>Banho e Secagem</span>
        <span>Corte de unhas</span>
        <span>Limpeza de ouvido</span>
        <span>Cortes de cabelo elegantes</span>
        <span>Escovas</span>
      </div>

      <p>
        Na Vet Care, nossos serviços profissionais de higiene são projetados
        para manter seus amigos peludos com a melhor aparência e se sentindo o melhor possível.
      </p>

      <div class="acoes">
        <button class="botao-agendar">Agendar consulta</button>
        <div class="preco">
          <select>
            <option>Porte Grande (18–36 kg): R$70</option>
            <option>Porte Médio (10–17 kg): R$55</option>
            <option>Porte Pequeno (até 9 kg): R$40</option>
          </select>
        </div>
      </div>
    </div>

    <div class="imagens-tosa">
      <div class="imagem-principal">
        <img src="./src/assets/img/tesoura.png"
          alt="Cachorro sendo tosado">
      </div>
      <div class="miniaturas">
        <img src="./src/assets/img/unha.png"
          alt="Cachorro branco">
        <img src="./src/assets/img/sla1.png" alt="Golden sendo penteado">
        <img src="./src/assets/img/sla2.png"
          alt="Bernese feliz">
      </div>
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