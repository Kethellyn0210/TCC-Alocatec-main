<?php
require_once '../../../login/login.php';

if (!Store::isLogged()) {
    header("Location: ../../index.php");
    exit();
}

$usuario = Store::get('usuario');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALOCATEC - Adicionar Instalaçõest</title>
    <link rel="stylesheet" href="adicionar_agendamento.css" />
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
        <li><a href="">INICIO</a></li>
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
      <h1>Adicionar Instalações</h1>

      <div class="form-card">
        <h2>Dados de Agendamento</h2>

        <form>
          <div class="form-row">
            <div>
              <label>Tempo de Uso</label>
              <input type="text" placeholder="Início">
            </div>
            <div>
              <label>&nbsp;</label>
              <input type="text" placeholder="Término">
            </div>
          </div>

          <div class="form-row">
            <div>
              <label>Disponibilidade</label>
                <div>
                  <select>
                    <option>Seg-Sex</option>
                    <option>Seg-Dom</option>
                    <option>Sab-Dom</option>
                  </select>
                </div>
            </div>
          </div>

          <div class="button-container">
            <button type="submit" class="salvar">Salvar</button>
            <button type="button" class="cancelar">Cancelar</button>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>
</html>