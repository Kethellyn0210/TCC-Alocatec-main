<?php
require_once '../../../login/login.php';

if (!Store::isLogged()) {
    header("Location: ../../index.php");
    exit();
}

$usuario = Store::get('usuario');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ALOCATEC - Adicionar Instalações</title>
  <link rel="stylesheet" href="adicionar_localizacao.css" />
    <link rel="icon" href="../img/logo.png" />    
    <link rel="shortcut icon" href="../img/logo.png" />
    
</head>
<body>
  <div class="container">
  <aside class="sidebar">
    <div class="logo">
    <div class="icone-logo">
      <img src="../img/logo.png">
    </div>
      <h2>ALOCATEC</h2>
    <br>
    <hr></hr>
    </div>
    <nav>
      <ul>
        <li><a href="../home/home.php">INICIO</a></li>
        <li><a href="../solicitacao/solicitacao.php">SOLICITAÇÕES</a></li>
        <li><a href="./fotos.php">INSTALAÇÕES</a></li>
        <li>NOTIFICAÇÕES</li>
      </ul>
    </nav>
    <div class="user">
        <div class="avatar"></div>
        <div class="user-info">
          <p class="nome"><?php echo htmlspecialchars($usuario['nome']); ?></p>
          <p class="cargo"><?php echo htmlspecialchars($usuario['email']); ?></p>
        </div>
        <a href="../../../login/logout.php" class="logout">SAIR</a>
      </div>
  </aside>

<main class="main">
      <h1 class="page-title">Adicionar Instalações</h1>

      <div class="form-card">
        <h2>Localização</h2>

        <form>
          <div class="form-row">
            <div class="campo maior">
              <label>Endereço</label>
              <input type="text" placeholder="">
            </div>
            <div class="campo pequeno">
              <label>Nº</label>
              <input type="text">
            </div>
          </div>

          <div class="form-row">
            <div>
              <label>Bairro</label>
              <input type="text">
            </div>
            <div>
              <label>CEP</label>
              <input type="text">
            </div>
            <div>
              <label>Cidade</label>
              <input type="text">
            </div>
          </div>

          <div class="form-row">
            <div>
              <label>Complemento</label>
              <input type="text">
            </div>
            <div>
              <label>UF</label>
              <input type="text" maxlength="2">
            </div>
          </div>

    <div class="button-container">
        <button class="botao-acao adicionar" onclick="window.location.href='../questionario_instalacao/form1/adicionar_descricao.php'">
        <button type="button" class="next-btn"
            onclick="window.location.href='../form3/adicionar_agendamento.php'"
            >Próximo</button>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>
</html>
