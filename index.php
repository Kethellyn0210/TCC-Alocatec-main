<?php
session_start();
require_once './database/conexao_bd_mysql.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

    $sql = "SELECT * FROM administrador WHERE email = '$email' AND senha = '$senha'";
    $result = mysqli_query($conexao_servidor_bd, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
      $_SESSION['usuario'] = $email;
      header("Location: ./pages/home/home.php");
      exit();
    } else {
      echo "<script>alert('Usuário ou senha incorretos!');</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ALOCATEC - Login</title>
  <link rel="stylesheet" href="./index.css">
  <link rel="icon" href="img/logo.png">
  <link rel="shortcut icon" href="img/logo.png">

</head>
<body>
  <div class="fundo">
    <img src="./img/foto_login.jpeg" alt="">
    <div class="caixa-login">
      <div class="logo">
        <img src="./img/logo-preto.png" alt="Logo" class="icone-logo">
        <h2 class="nome-logo">ALOCATEC</h2>
      </div>

      <form class="formulario" method="POST" action="">
        <label for="email" class="rotulo">Email</label>
        <input type="text" id="email" name="email" class="campo-texto" placeholder="Digite seu email" required>

        <label for="senha" class="rotulo">Senha</label>
        <input type="password" id="senha" name="senha" class="campo-texto" placeholder="Digite sua senha" required>

        <a href="./pages/cadastro/cadastro.php" class="link-cadastro">Cadastre-se</a>

        <button type="submit" class="botao-entrar">Entrar</button>
      </form>
    </div>
  </div>
</body>
</html>
