<?php

session_start();

require_once('../src/config/conexao.php');


if ($_SERVER['REQUEST_METHOD']== 'POST') {

    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $genero = $_POST['genero'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];
    $cpf = $_POST['cpf'];

    try {
        $sql = "INSERT INTO usuario (nome, sobrenome, genero, email, senha, telefone, data_nascimento, CPF) VALUES (:nome, :sobrenome, :genero, :email, :senha, :telefone, :data_nascimento, :cpf)";

        $stmt = $pdo -> prepare($sql);
        $stmt -> bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt -> bindParam(':sobrenome', $sobrenome, PDO::PARAM_STR);
        $stmt -> bindParam(':genero', $genero, PDO::PARAM_STR);
        $stmt -> bindParam(':email', $email, PDO::PARAM_STR);
        $stmt -> bindParam(':senha', $senha, PDO::PARAM_STR);
        
        $stmt->bindParam(':senha', $senhaHash, PDO::PARAM_STR);

        $stmt -> bindParam(':telefone', $telefone, PDO::PARAM_STR);
        $stmt -> bindParam(':data_nascimento', $data_nascimento, PDO::PARAM_STR);
        $stmt -> bindParam(':cpf', $cpf, PDO::PARAM_STR);
        

        $stmt -> execute();

        $usuario_id = $pdo -> lastInsertId();

        echo "<p style='color:green;'>Cadastrado realizado com sucesso! ID: " . $usuario_id . "</p>";
    } catch(PDOException $e){
        echo "<p style='color:red;'>Erro ao realizar cadastrar: " . $e -> getMessage() . "</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
  <link rel="stylesheet" href="../src/assets/css/cadastro.css">
</head>
  <header>
    <div class="logo">
      <img src="../src/assets/img/logo.png" alt="" height="80px">
    </div>
    <nav>
      <ul>
          <li><a href="../home.php">Home</a></li>
          <li><a href="../servicos.html">Nossos Serviços</a></li>
          <li><a href="../sobre-nos.html">Sobre Nós</a></li>
          <li><a href="../contato.html">Contato</a></li>
          <li><a href="../emergencia.html">Emergência</a></li>
      </ul>
    </nav>
</header>

<body>

<a href="login.php" class="seta">
        <img src="../src/assets/img/seta.png" alt="" height="50px">
</a>

<br><br> 
    <div class="form-container">
    <h3 class="form-title">Dados Pessoais</h3>

    <form action="" method="post">

        <div class="form-grid">

            <div class="form-group">
                <label for="email">E-mail*</label>
                <input type="email" name="email" id="email" required placeholder="exemplo@gmail.com">
            </div>

            <div class="form-group">
                <label for="cpf">CPF*</label>
                <input type="text" name="cpf" id="cpf" required placeholder="000.000.000-00">
            </div>

            <div class="form-group">
                <label for="nome">Primeiro nome*</label>
                <input type="text" name="nome" id="nome" required>
            </div>

            <div class="form-group">
                <label for="sobrenome">Segundo nome*</label>
                <input type="text" name="sobrenome" id="sobrenome" required>
            </div>

            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento*</label>
                <input type="date" name="data_nascimento" id="data_nascimento" required>
            </div>

            <div class="form-group">
                <label for="genero">Gênero*</label>
                <select id="genero" name="genero" required>
                    <option value="">Selecione...</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                    <option value="O">Outro</option>
                </select>
            </div>

            <div class="form-group">
                <label for="senha">Informe a senha*</label>
                <input type="password" name="senha" id="senha" required>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone*</label>
                <input type="text" name="telefone" id="telefone" required placeholder="(00) 00000-0000">
            </div>

        </div>

        <div class="form-button-area">
            <button type="submit" class="btn-cadastrar">Cadastrar</button>
        </div>

    </form>
</div>

<br><br><br><br>
</body>

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
</html>