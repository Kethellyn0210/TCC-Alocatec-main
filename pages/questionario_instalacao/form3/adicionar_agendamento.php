<?php
// adicionar_agendamento.php
session_start();
require_once '../../../login/login.php'; // ajuste caminho

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../../index.php");
    exit();
}
$usuario = $_SESSION['usuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['endereco']     = isset($_POST['endereco']) ? trim($_POST['endereco']) : '';
    $_SESSION['numero']       = isset($_POST['numero']) ? trim($_POST['numero']) : '';
    $_SESSION['bairro']       = isset($_POST['bairro']) ? trim($_POST['bairro']) : '';
    $_SESSION['cep']          = isset($_POST['cep']) ? trim($_POST['cep']) : '';
    $_SESSION['cidade']       = isset($_POST['cidade']) ? trim($_POST['cidade']) : '';
    $_SESSION['complemento']  = isset($_POST['complemento']) ? trim($_POST['complemento']) : '';
    $_SESSION['uf']           = isset($_POST['uf']) ? strtoupper(trim($_POST['uf'])) : '';
} else {
    header("Location: adicionar_localizacao.php");
    exit();
}
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
      <script>
    function confirmarSalvar() {
      return confirm("Tem certeza que deseja salvar esta instalação?");
    }
  </script>

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
        <li><a href="../../solicitacao/solicitacao.php">SOLICITAÇÕES</a></li>
        <li><a href="../../instalacoes/instalacoes.php">INSTALAÇÕES</a></li>
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

        <form method="post" onsubmit="return confirmarSalvar()" action="../salvar_instalacao.php">
          <div class="form-row">
            <div>
              <label>Tempo de Uso</label>
            <input type="text" placeholder="Início" name="inicio" required> </div>
            <div>
              <label>&nbsp;</label>
              <input type="text" placeholder="Término" name="termino" required> </div>
          </div>

          <div class="form-row">
            <div>
              <label>Disponibilidade</label>
                <div>
                  <select name="disponibilidade">
                    <option>Seg-Sex</option>
                    <option>Seg-Dom</option>
                    <option>Sab-Dom</option>
                  </select>
                </div>
            </div>

            <div>
              <label>Status</label>
                <div>
                  <select name="status">
                    <option>Ativo</option>
                    <option>Inativo</option>
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