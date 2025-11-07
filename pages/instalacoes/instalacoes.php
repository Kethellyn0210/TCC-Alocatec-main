<?php
require_once '../../login/login.php';

if (!Store::isLogged()) {
    header("Location: ../../index.php");
    exit();
}

$usuario = Store::get('usuario');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ALOCATEC - Instalações</title>
  <link rel="stylesheet" href="instalacoes.css">
     <link rel="icon" href="img/logo.png">
  <link rel="shortcut icon" href="img/logo.png">
</head>
<body>

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
      <a href="../../login/logout.php" class="logout">SAIR</a>
    </div>
  </aside>

  <div class="content">
    <div class="page">
      <div class="titulo-pagina">
        <h1>Instalações</h1>
        <p>Lista de instalações.</p>
    </div>
  <div class="acoes-topo">
  <button class="botao-acao atualizar" onclick="location.reload()">
    <img src="./img/atualizar.png" alt="Atualizar">
  </button>
  <button class="botao-acao adicionar" onclick="window.location.href='../questionario_instalacao/form1/adicionar_descricao.php'">
    <img src="./img/adicao.png" alt="Adicionar">
    <span>ADICIONAR</span>
  </button>
</div>
</div>

  <div class="nao-sei">
   <div class="status">
    <h2>Registradas</h2>
     <?php 
		require_once '../../database/conexao_bd_mysql.php'; 
        $sql = "SELECT COUNT(*) AS id_estabelecimento FROM estabelecimento";
        $usuarios = mysqli_query($conexao_servidor_bd, $sql);
        foreach ($usuarios as $key => $value) {
            echo "<div class='resultado'>" . $value['id_estabelecimento'] . "</div>";
        }
        ?>
   </div>
   <div class="status">
    <h2>Ativas</h2>
    <?php 
		require_once '../../database/conexao_bd_mysql.php'; 
        $sql = "SELECT COUNT(*) AS status FROM estabelecimento WHERE status = 'Ativo'";
        $usuarios = mysqli_query($conexao_servidor_bd, $sql);
        foreach ($usuarios as $key => $value) {
            echo "<div class='resultado'>" . $value['status'] . "</div>";
        }
        ?>
   </div>
   <div class="status">
    <h2>Inativas</h2>
    <?php 
		require_once '../../database/conexao_bd_mysql.php'; 
        $sql = "SELECT COUNT(*) AS status FROM estabelecimento WHERE status = 'Inativo'";
        $usuarios = mysqli_query($conexao_servidor_bd, $sql);
        foreach ($usuarios as $key => $value) {
            echo "<div class='resultado'>" . $value['status'] . "</div>";
        }
        ?>
   </div>
   </div>

 <div class="filters">
  <div class="search">
    <img src="./img/lupa.png">
    <input placeholder="Verificar Instalações"/>
  </div>

  <div class="chip">
    <input placeholder="Instalações"/>
  </div>

  <div class="chip">
    <select>
      <option>Status</option>
      <option>Ativo</option>
      <option>Inativo</option>
    </select>
  </div>
</div>

<?php 
require_once '../../database/conexao_bd_mysql.php';

$sql = "
SELECT nome, endereco, status, inicio, termino, disponibilidade
FROM estabelecimento 
LIMIT 3
";

$reservas = mysqli_query($conexao_servidor_bd, $sql);

if ($reservas && mysqli_num_rows($reservas) > 0) {
    while ($value = mysqli_fetch_assoc($reservas)) {
        echo "
        <div class='solicitacao-card'>
          <div class='topo-solicitacao'>
            <div class='nome-espaco'>
              <h2>" . htmlspecialchars($value['nome']) . "</h2>
            </div>
            <div class='status-solicitacao " . htmlspecialchars($value['status']) . "'>
              <h2>" . htmlspecialchars($value['status']) . "</h2>
            </div>
          </div>
          <div class='detalhes-solicitacao'>
            <div class='detalhe'>
              <h3>Endereço:</h3>
              <p>" . htmlspecialchars($value['endereco']) . "</p>
            </div>
               <div class='detalhe'>
              <h3>Início:</h3>
              <p>" . htmlspecialchars($value['inicio']) . "</p>
            </div>
               <div class='detalhe'>
              <h3>Término:</h3>
              <p>" . htmlspecialchars($value['termino']) . "</p>
            </div>
               <div class='detalhe'>
              <h3>Disponibilidade:</h3>
              <p>" . htmlspecialchars($value['disponibilidade']) . "</p>
            </div>
          </div>
        </div>
        ";
    }
} else {
    echo "<div class='encontrada'>
    <h2>Nenhuma Instalação encontrada.</h2>
    </div>";
}
?>
  </div>

</body>
</html>