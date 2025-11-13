<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../../database/conexao_bd_mysql.php';

if (!isset($_GET['id_estabelecimento'])) {
  die("<h1'>Estabelecimento não especificado.</h1>");
}

$id = intval($_GET['id_estabelecimento']);

$sql = "
SELECT e.id_estabelecimento, e.nome, e.endereco, e.numero, e.bairro, e.cep, 
       e.cidade, e.complemento, e.uf, e.inicio, e.termino, e.disponibilidade, e.status,
       s.id_espaco, s.tipo, s.capacidade, s.cobertura, s.largura, s.comprimento, 
       s.localidade 
FROM estabelecimento e
JOIN espaco s ON e.id_estabelecimento = s.id_estabelecimento
WHERE e.id_estabelecimento = $id;
";

$result = mysqli_query($conexao_servidor_bd, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Instalação não encontrada.");
}

$dados = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Instalação</title>
  <link rel="stylesheet" href="editar_instalacao.css">
</head>
<body>
  <h1>Editar Instalação</h1>

  <form method="POST" action="./salvar/salvar_edicao_instalacao.php">
    <input type="hidden" name="id_estabelecimento" value="<?php echo $dados['id_estabelecimento']; ?>">
    <input type="hidden" name="id_espaco" value="<?php echo $dados['id_espaco']; ?>">

    <label>Nome do Espaço:</label>
    <input type="text" name="nome" value="<?php echo htmlspecialchars($dados['nome']); ?>"><br>

    <label>Tipo:</label>
    <input type="text" name="tipo" value="<?php echo htmlspecialchars($dados['tipo']); ?>"><br>

    <label>Capacidade:</label>
    <input type="text" name="capacidade" value="<?php echo htmlspecialchars($dados['capacidade']); ?>"><br>

<label>Cobertura:</label>
<select name="cobertura">
  <option value="Sim" <?= ($dados['cobertura'] === 'Sim') ? 'selected' : '' ?>>Sim</option>
  <option value="Não" <?= ($dados['cobertura'] === 'Não') ? 'selected' : '' ?>>Não</option>
</select><br>

<label>Status:</label>
<select name="status">
  <option value="Ativo" <?= ($dados['status'] === 'Ativo') ? 'selected' : '' ?>>Ativo</option>
  <option value="Inativo" <?= ($dados['status'] === 'Inativo') ? 'selected' : ''?>>Inativo</option>
</select>


    <label>Início:</label>
    <input type="time" name="inicio" value="<?php echo htmlspecialchars($dados['inicio']); ?>"><br>

    <label>Término:</label>
    <input type="time" name="termino" value="<?php echo htmlspecialchars($dados['termino']); ?>"><br>

<label>Disponibilidade:</label>
<select name="disponibilidade">
  <option value="Seg-Sex" <?php if (strtoupper(trim($dados['disponibilidade'])) == 'SEG-SEX') echo 'selected'; ?>>Seg-Sex</option>
  <option value="Seg-Dom" <?php if (strtoupper(trim($dados['disponibilidade'])) == 'SEG-DOM') echo 'selected'; ?>>Seg-Dom</option>
  <option value="Sab-Dom" <?php if (strtoupper(trim($dados['disponibilidade'])) == 'SAB-DOM') echo 'selected'; ?>>Sab-Dom</option>
</select><br>

    <button type="submit">Salvar alterações</button>
  </form>
</body>
</html>
