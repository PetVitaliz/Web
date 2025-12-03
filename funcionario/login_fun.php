<?php

session_start();

if(isset($_SESSION['mensagem_erro'])) {
    echo '<p>' . $_SESSION['mensagem_erro'] . '</p>';
    unset($_SESSION['mensagem_erro']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Funcionario</title>
    <link rel="stylesheet" href="../src/assets/css/login.css">
</head>
<body>
  <header>
    <div class="logo">
      <img src="../src/assets/img/logo.png" alt="" height="80px">
    </div>
    <nav>
      <ul>
        <li><a href="../home.php">Home</a></li>
        <li><a href="../pagina_serviços/">Nossos Serviços</a></li>
        <li><a href="../pagina_sobre_nos/">Sobre Nós</a></li>
        <li><a href="../pagina_contato/">Contato</a></li>
        <li><a href="../pagina_emergencia/">Emergência</a></li>
      </ul>
    </nav>
  </header>

    <h2>Login Funcionario</h2>

    <style>
        h2 {
            display: flex;
            justify-content: center;
            position: relative;
            bottom: -90px;
            font-size: 30px;
        }
    </style>

    <form action="../src/config/processa_login_fun.php" method="post">
        <label for="text">Registro:</label>
        <input type="text" id="registro" name="registro" required>
        <p>

        <label for="senha">Senha:</label>
        <input type="text" id="senha" name="senha" required>
        <p>

        <input type="submit" value="Entrar">

        
        <?php 
            if (isset($_GET['erro'])) {
                echo '<p style="color: red;">registro ou senha incorretos!</p>';
            }
        ?>

    </form>

    <br><br><br><br>
<footer class="footer">
  <div class="PataGrandeFooder">
    <img src="../src/assets/img/PataGrandeFooter.png" alt="Imagem de fundo de patas" class="paws-background-img">
  </div>


  <div class="footer-logo">
    <img src="../src/assets/img/PataPequenaFooter.png" alt="Logo PetVital" class="footer-logo-icon"> PetVital
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
      <img src="../src/assets/img/Instagram.png" alt="Ícone Instagram" class="social-icon-img">
      <img src="../src/assets/img/Behance.png" alt="Ícone Behance" class="social-icon-img">
      <img src="../src/assets/img/Dribbble.png" alt="Ícone dribbble" class="social-icon-img">
      <img src="../src/assets/img/LinkedIn.png" alt="Ícone LinkedIn" class="social-icon-img">
    </div>
  </div>
</footer>

</body>
</html>

