<?php
require_once '../../login/login.php';

if (!Store::isLogged()) {
    header("Location: ../../index.php");
    exit();
}

$usuario = Store::get('usuario');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Solicitação - Alocatec</title>
    <link rel="stylesheet" href="gerenciar.css">
         <link rel="icon" href="img/logo.png">
  <link rel="shortcut icon" href="img/logo.png">
</head>
<body>

<div class="container">

    <aside class="sidebar">
    <div class="logo">
    <div class="icone-logo">
      <img src="./img/logo.png">
    </div>
      <h2>ALOCATEC</h2>
    <br>
    <hr></hr>
    </div>
    <nav>
      <ul>
        <li><a href="../solicitacao/solicitacao.php">SOLICITAÇÕES</a></li>
        <li><a href="../instalacoes/instalacoes.php">INSTALAÇÕES</a></li>
      </ul>
    </nav>
    <div class="user">
    <div class="avatar"></div>
 <div class="user-info">
          <p class="nome"><?php echo htmlspecialchars($usuario['nome']); ?></p>
          <p class="cargo"><?php echo htmlspecialchars($usuario['email']); ?></p>
        </div>
      <a href="../../login/logout.php" class="logout">SAIR</a>
    </div>
  </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="content">
        <h1>Gerenciar Solicitação</h1>

        <!-- Dados do Agendamento -->
        <section class="card">
            <h2>Dados do Agendamento</h2>
            <div class="grid">
                <p><strong>DATA SOLICITADA</strong></p>
                <p><strong>CAPACIDADE</strong></p>
                <p><strong>HORA INICIO</strong></p>
                <p><strong>DATA DA RESERVA</strong></p>
                <p><strong>HORA TERMINO</strong></p>
                <p><strong>HORA DA RESERVA</strong></p>
            </div>
        </section>

        <!-- Dados do Usuário + Endereço -->
        <section class="card row">
            <div class="col">
                <h2>Dados do Usuário</h2>
                <p><strong>NOME USUÁRIO</strong></p>
                <p><strong>E-MAIL</strong></p>
                <p><strong>DATA DE NASCIMENTO</strong></p>
                <p><strong>TELEFONE</strong></p>
            </div>

            <div class="col">
                <h2>Dados do Endereço</h2>
                <p><strong>RUA</strong></p>
                <p><strong>NÚMERO</strong></p>
                <p><strong>CIDADE</strong></p>
                <p><strong>CEP</strong></p>
            </div>
        </section>

        <!-- Instalação -->
        <section class="card row">
            <div class="col">
                <h2>Dados da Instalação</h2>
                <p><strong>NOME DA INSTALAÇÃO</strong></p>
                <p><strong>HORÁRIO ABERTURA</strong></p>
                <p><strong>HORÁRIO FECHAMENTO</strong></p>
            </div>

            <div class="col">
                <h2>Endereço</h2>
                <p><strong>NOME DA RUA</strong></p>
                <p><strong>CEP  CIDADE</strong></p>
            </div>

            <div class="install-img">
                <img src="./img/futebol.png" alt="Imagem da Instalação">
            </div>
        </section>

        <div class="actions">
            <button class="accept">Aceitar</button>
            <button class="reject">Recusar</button>
        </div>

    </main>

</div>

</body>
</html>
