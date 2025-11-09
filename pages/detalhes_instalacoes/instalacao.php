<?php
require_once '../../database/conexao_bd_mysql.php'; // conexão com o banco
require_once '../../login/login.php';

if (!Store::isLogged()) {
  header("Location: ../../index.php");
  exit();
}

$usuario = Store::get('usuario');

if (!isset($_GET['id_estabelecimento'])) {
  die("Estabelecimento não especificado.");
}

$id_estabelecimento = intval($_GET['id_estabelecimento']); 

$sql_estabelecimento = "
    SELECT nome, endereco, numero, bairro, cep, cidade, 
           complemento, uf, inicio, termino, disponibilidade, status
    FROM estabelecimento
    WHERE id_estabelecimento = $id_estabelecimento;
";

$result_estab = mysqli_query($conexao_servidor_bd, $sql_estabelecimento);

if (!$result_estab || mysqli_num_rows($result_estab) == 0) {
  die("Estabelecimento não encontrado.");
}

$dados_estab = mysqli_fetch_assoc($result_estab);


$sql_espaco = "
      SELECT tipo, capacidade, cobertura, largura, comprimento, 
    localidade, E.id_estabelecimento
    FROM espaco E
    INNER JOIN estabelecimento T ON E.id_estabelecimento = T.id_estabelecimento
    WHERE T.id_estabelecimento = 1;
";

$result_espaco = mysqli_query($conexao_servidor_bd, $sql_espaco);

if (!$result_espaco || mysqli_num_rows($result_espaco) == 0) {
  die("Espaço não encontrado.");
}

$dados_espaco = mysqli_fetch_assoc($result_espaco);

$tipo_espaco     = $dados_espaco['tipo'];
$cobertura       = $dados_espaco['cobertura'];
$capacidade      = $dados_espaco['capacidade'];
$largura         = $dados_espaco['largura'];
$comprimento     = $dados_espaco['comprimento'];

$nome_espaco      = $dados_estab['nome'];
$endereco        = $dados_estab['endereco'];
$numero          = $dados_estab['numero'];
$bairro          = $dados_estab['bairro'];
$cep             = $dados_estab['cep'];
$cidade          = $dados_estab['cidade'];
$complemento     = $dados_estab['complemento'];
$uf              = $dados_estab['uf'];
$inicio          = $dados_estab['inicio'];
$termino         = $dados_estab['termino'];
$disponibilidade = $dados_estab['disponibilidade'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ALOCATEC - Instalações</title>
  <link rel="stylesheet" href="instalacao.css">
  <link rel="icon" href="img/logo.png">
  <link rel="shortcut icon" href="img/logo.png">
</head>
<body>

  <aside class="sidebar">
    <div class="logo">
      <div class="icone-logo">
        <img src="./img/logo.png" alt="Logo">
      </div>
      <h2>ALOCATEC</h2>
      <br><hr>
    </div>
    <nav>
      <ul>
        <li><a href="../home/home.php">INÍCIO</a></li>
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

  <main class="content">
    <div class="header-form">
      <h2><?php echo htmlspecialchars($nome_espaco); ?></h2>
      <span class="status-ativo">Ativo</span>
    </div>

    <form class="form">
      <div class="form-group full">
        <label>Nome do Espaço</label>
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
          <label>Largura</label>
          <p><?php echo htmlspecialchars($largura); ?></p>
        </div>
        <div class="form-group">
          <label>Comprimento</label>
          <p><?php echo htmlspecialchars($comprimento); ?></p>
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
          <label>Horário de Funcionamento</label>
          <p><?php echo htmlspecialchars($inicio . ' - ' . $termino); ?></p>
        </div>
      </div>

      <div class="form-group full">
        <label>Disponibilidade</label>
        <p><?php echo htmlspecialchars($disponibilidade); ?></p>
      </div>
    </form>

    <div class="form-actions">
      <button type="button" class="btn btn-apagar">Apagar</button>
      <button type="button" class="btn btn-editar">Editar</button>
      <button type="button" class="btn btn-voltar">Voltar</button>
    </div>
  </main>

</body>
</html>
