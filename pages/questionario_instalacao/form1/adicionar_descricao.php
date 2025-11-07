<?php
require_once '../../../login/login.php';

if (!Store::isLogged()) {
    header("Location: ../../../index.php");
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
  <link rel="stylesheet" href="adicionar_descricao.css" />
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

      <section class="form-card">
        <h2>Descrição do Espaço</h2>

        <form>
          <label>Nome da Espaço</label>
          <input type="text" />

          <div class="form-row">
            <div>
              <label>Tipo de Espaço/Esporte</label>
              <input type="text" />
            </div>
            <div>
              <label>Cobertura</label>
              <input type="text" />
            </div>
            <div>
              <label>Capacidade</label>
              <input type="text" />
            </div>
          </div>

          <label>Tamanho do Espaço</label>
          <div class="form-row">
            <input type="text" placeholder="Largura" />
            <input type="text" placeholder="Comprimento" />
          </div>

          <div class="button-container">
            <button class="botao-acao adicionar" onclick="window.location.href='../questionario_instalacao/form1/adicionar_descricao.php'">
            <button type="button" class="next-btn"
            onclick="window.location.href='../form2/adicionar_localizacao.php'"
            >Próximo</button>
          </div>
        </form>
      </section>
    </main>
  </div>
</body>
</html>
