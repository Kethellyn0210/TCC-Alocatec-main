<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../../login/login.php';
require_once '../../database/conexao_bd_mysql.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.php");
    exit();
}

$usuario = $_SESSION['usuario'];

$inicio          = $_POST['inicio'] ?? null;
$termino         = $_POST['termino'] ?? null;
$disponibilidade = $_POST['disponibilidade'] ?? null;

$status = $_POST['status'] ?? 'Ativo';

if (!in_array($status, ['Ativo', 'Inativo'])) {
    $status = 'Ativo'; 
}

$requiredSession = [
    'nome_espaco','tipo_espaco','cobertura','capacidade',
    'largura','comprimento','endereco','numero','bairro',
    'cep','cidade','complemento','uf'
];

foreach ($requiredSession as $key) {
    if (!isset($_SESSION[$key])) {
        die("Erro: dado de sessão faltando ($key). Volte e preencha todos os passos.");
    }
}

$id = $usuario['id'];

$nome_espaco = $_SESSION['nome_espaco'];
$tipo_espaco = $_SESSION['tipo_espaco'];
$cobertura   = $_SESSION['cobertura'];
$capacidade  = intval($_SESSION['capacidade']);
$largura     = $_SESSION['largura'];
$comprimento = $_SESSION['comprimento'];
$descricao_adicional = $_SESSION['descricao_adicional'];
$endereco    = $_SESSION['endereco'];
$numero      = $_SESSION['numero'];
$bairro      = $_SESSION['bairro'];
$cep         = $_SESSION['cep'];
$cidade      = $_SESSION['cidade'];
$complemento = $_SESSION['complemento'];
$uf          = $_SESSION['uf'];

$tamanho_espaco = $largura . ' x ' . $comprimento;
$tempo_uso      = $inicio . ' - ' . $termino;

mysqli_begin_transaction($conexao_servidor_bd);

$sql1 = "
    INSERT INTO estabelecimento (
        nome_est, tipo, status, endereco, numero, bairro, cep, cidade, 
        complemento, uf, inicio, termino, disponibilidade, id_administrador
    ) VALUES (
        '$nome_espaco', '$tipo_espaco', '$status', '$endereco', '$numero', '$bairro',
        '$cep', '$cidade', '$complemento', '$uf', 
        '$inicio', '$termino', '$disponibilidade', $id
    );
";

if (mysqli_query($conexao_servidor_bd, $sql1)) {
    $id_estabelecimento = mysqli_insert_id($conexao_servidor_bd);

    $sql2 = "
        INSERT INTO espaco (
          capacidade, cobertura, largura, comprimento, descricao_adicional, localidade, id_estabelecimento
        ) VALUES (
            '$capacidade', '$cobertura', '$largura', '$comprimento', 
            '$descricao_adicional', '$endereco', $id_estabelecimento
        );
    ";

    if (mysqli_query($conexao_servidor_bd, $sql2)) {
        mysqli_commit($conexao_servidor_bd);
        $mensagem = "Instalação salva com sucesso!";
        $tipo_mensagem = "Sucesso";
        foreach ($requiredSession as $key) {
            unset($_SESSION[$key]);
        }
    } else {
        mysqli_rollback($conexao_servidor_bd);
        $mensagem = "Erro ao salvar espaço: " . mysqli_error($conexao_servidor_bd);
        $tipo_mensagem = "Erro";
    }
} else {
    mysqli_rollback($conexao_servidor_bd);
    $mensagem = "Erro ao salvar estabelecimento: " . mysqli_error($conexao_servidor_bd);
    $tipo_mensagem = "Erro";
}

mysqli_close($conexao_servidor_bd);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ALOCATEC - Salvar Instalação</title>
  <link rel="stylesheet" href="salvar_instalacao.css">
  <link rel="icon" href="./img/logo.png">
  <link rel="shortcut icon" href="img/logo.png">
  <style>
.resuldado-Sucesso, .resuldado-Erro {
  width: 100%;
  max-width: 900px;
  margin: 10px auto;
  padding: 20px 10px;
  border-radius: 10px;
  font-size: 15px;
}

.resuldado-Sucesso {
  background-color: #e6ffee;
  border-left: 6px solid #00c853;
  color: #007a33;
  font-size: 1rem;
  font-weight: 600;
}

.resuldado-Erro {
  background-color: #ffeaea;
  border-left: 6px solid #e53935;
  color: #b71c1c;
  font-size: 1rem;
  font-weight: 600;
}
  </style>
</head>

<body>
  <div class="container">
    <aside class="sidebar">
      <div class="logo">
        <div class="icone-logo">
          <img src="./img/logo.png" alt="Logo">
        </div>
        <h2>ALOCATEC</h2>
        <br>
        <hr>
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

    <main class="main">
       <div class="page-title">
      <div class="titulo-pagina">
        <h1>Instalações</h1>
        <p>Lista de instalações.</p>
    </div>
  <div class="acoes-topo">
  <button class="botao-acao voltar" onclick="window.location.href='../instalacoes/instalacoes.php'">
    <img src="./img/voltar.png">
    <span>VOLTAR</span>
  </button>
</div>
</div>

<div class="resuldado<?= $tipo_mensagem === 'Sucesso' ? '-Sucesso' : '-Erro' ?>">
  <?php echo htmlspecialchars($mensagem); ?>
</div>

      <form class="form">
        <div class="form-group full">
          <label>Nome da Espaço</label>
          <p><?php echo htmlspecialchars($nome_espaco); ?></p>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Tipo de Espaço/Esporte</label>
            <p><?php echo htmlspecialchars($tipo_espaco); ?></p>
          </div>
          <div class="form-group">
            <label>Cobertura</label>
            <p><?php echo htmlspecialchars($cobertura); ?></p>
          </div>
          <div class="form-group">
            <label>Capacidade</label>
            <p><?php echo htmlspecialchars($capacidade); ?></p>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Tamanho do Espaço</label>
            <p><?php echo htmlspecialchars($tamanho_espaco); ?></p>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group large">
            <label>Endereço</label>
            <p><?php echo htmlspecialchars($endereco); ?></p>
          </div>
          <div class="form-group small">
            <label>Nº</label>
            <p><?php echo htmlspecialchars($numero); ?></p>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Bairro</label>
            <p><?php echo htmlspecialchars($bairro); ?></p>
          </div>
          <div class="form-group">
            <label>CEP</label>
            <p><?php echo htmlspecialchars($cep); ?></p>
          </div>
          <div class="form-group">
            <label>Cidade</label>
            <p><?php echo htmlspecialchars($cidade); ?></p>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group large">
            <label>Complemento</label>
            <p><?php echo htmlspecialchars($complemento); ?></p>
          </div>
          <div class="form-group small">
            <label>UF</label>
            <p><?php echo htmlspecialchars($uf); ?></p>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Tempo de Uso</label>
            <p><?php echo htmlspecialchars($tempo_uso); ?></p>
          </div>
        </div>

        <div class="form-group full">
          <label>Disponibilidade</label>
          <p><?php echo htmlspecialchars($disponibilidade); ?></p>
        </div>
      </form>
    </main>
  </div>
</body>
</html>
