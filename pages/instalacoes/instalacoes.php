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
    <style>
.msg-sucesso,
.msg-erro {
  width: 100%;
  max-width: 900px;
  margin: 10px auto;
  padding: 20px 10px;
  border-radius: 10px;
  font-size: 15px;
}

.msg-sucesso {
  background-color: #e6ffee;
  border-left: 6px solid #00c853;
  color: #007a33;
  font-size: 1rem;
  font-weight: 600;
}

.msg-erro {
  background-color: #ffeaea;
  border-left: 6px solid #e53935;
  color: #b71c1c;
  font-size: 1rem;
  font-weight: 600;
}

.msg-sucesso.fade-out,
.msg-erro.fade-out {
  opacity: 0;
  pointer-events: none;
}
</style>
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

<?php
if (isset($_SESSION['mensagem_apagar'])) {
    $mensagem = $_SESSION['mensagem_apagar'];
    $classe = $mensagem['tipo'] === 'sucesso' ? 'msg-sucesso' : 'msg-erro';
    echo "<div class='$classe'>{$mensagem['texto']}</div>";
    unset($_SESSION['mensagem_apagar']);
}
?>

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

$limite = 3;

$onde_estou = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

$linha_mysql = ($onde_estou - 1) * $limite;

$total_query = "SELECT COUNT(*) AS total FROM estabelecimento";
$total_result = mysqli_query($conexao_servidor_bd, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total = $total_row['total'];
$total_pag = ceil($total / $limite);

$sql = "
SELECT id_estabelecimento, nome_est, endereco, status, inicio, termino, disponibilidade
FROM estabelecimento
LIMIT $linha_mysql, $limite
";
$reservas = mysqli_query($conexao_servidor_bd, $sql);

if ($reservas && mysqli_num_rows($reservas) > 0) {
    while ($value = mysqli_fetch_assoc($reservas)) {
      $id = htmlspecialchars($value['id_estabelecimento']);
        echo "
        <div class='solicitacao-card' data-id='$id' onclick=\"window.location.href='../detalhes_instalacoes/instalacao.php?id_estabelecimento=$id'\">
          <div class='topo-solicitacao'>
            <div class='nome-espaco'>
              <h2>" . htmlspecialchars($value['nome_est']) . "</h2>
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
    echo "<div class='erro'>
        <h2>Nenhuma solicitação encontrada</h2>
      </div>";
}
?>

<div class="pagination-dots">
    <?php for ($i = 1; $i <= $total_pag; $i++): ?>
        <?php $class = ($i == $onde_estou) ? 'active' : ''; ?>
        <a href="?page=<?php echo $i; ?>" class="dot <?php echo $class; ?>"></a>
    <?php endfor; ?>
</div>

</body>
</html>