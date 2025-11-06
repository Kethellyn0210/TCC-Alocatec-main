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
        <?php
        require_once '../../database/conexao_bd_mysql.php';
        $sql = "SELECT nome, email FROM administrador LIMIT 1";
        $usuarios = mysqli_query($conexao_servidor_bd, $sql);
                foreach ($usuarios as $key => $value) {
            echo "<p class='nome'>" . $value['nome'] . "</p>";
            echo "<p class='email'>" . $value['email'] . "</p>";
        }     
      ?>
      </div>
      <a href="#" class="logout">SAIR</a>
    </div>
  </aside>

  <div class="content">
    <div class="page">
        <h1>Solicitações</h1>
        <p>Lista de todas as solicitações de reserva.</p>
    </div>
  <div class="nao-sei">
   <div class="status">
    <h2>Pendentes</h2>
     <?php 
		require_once '../../database/conexao_bd_mysql.php'; 
        $sql = "SELECT COUNT(*) AS status FROM reserva WHERE status = 'Pendente'";
        $usuarios = mysqli_query($conexao_servidor_bd, $sql);
        foreach ($usuarios as $key => $value) {
            echo "<div class='resultado'>" . $value['status'] . "</div>";
        }
        ?>
   </div>
   <div class="status">
    <h2>Autorizados</h2>
    <?php 
		require_once '../../database/conexao_bd_mysql.php'; 
        $sql = "SELECT COUNT(*) AS status FROM reserva WHERE status = 'concluída'";
        $usuarios = mysqli_query($conexao_servidor_bd, $sql);
        foreach ($usuarios as $key => $value) {
            echo "<div class='resultado'>" . $value['status'] . "</div>";
        }
        ?>
   </div>
   <div class="status">
    <h2>Recusados</h2>
    <?php 
		require_once '../../database/conexao_bd_mysql.php'; 
        $sql = "SELECT COUNT(*) AS status FROM reserva WHERE status = 'cancelada'";
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
      <option>Pendente</option>
      <option>Autorizados</option>
      <option>Recusados</option>
    </select>
  </div>
</div>

<?php 
require_once '../../database/conexao_bd_mysql.php';

$sql = "
SELECT 
    R.id_reserva,
    R.data,
    R.horario,
    R.status,
    U.nome AS usuario,
    E.tipo AS espaco
FROM reserva R
INNER JOIN usuario U ON R.id_usuario = U.id_usuario
INNER JOIN espaco E ON R.id_espaco = E.id_espaco
LIMIT 3
";

$reservas = mysqli_query($conexao_servidor_bd, $sql);

if ($reservas && mysqli_num_rows($reservas) > 0) {
    while ($value = mysqli_fetch_assoc($reservas)) {
        echo "
        <div class='solicitacao-card'>
          <div class='topo-solicitacao'>
            <div class='nome-espaco'>
              <h2>" . htmlspecialchars($value['espaco']) . "</h2>
            </div>
            <div class='status-solicitacao " . htmlspecialchars($value['status']) . "'>
              <h2>" . htmlspecialchars($value['status']) . "</h2>
            </div>
          </div>
          <div class='detalhes-solicitacao'>
            <div class='detalhe'>
              <h3>Data:</h3>
              <p>" . htmlspecialchars($value['data']) . "</p>
            </div>
            <div class='detalhe'>
              <h3>Horário:</h3>
              <p>" . htmlspecialchars($value['horario']) . "</p>
            </div>
            <div class='detalhe'>
              <h3>Usuario:</h3>
              <p>" . htmlspecialchars($value['usuario']) . "</p>
            </div>
          </div>
        </div>
        ";
    }
} else {
    echo "<p>Nenhuma reserva encontrada.</p>";
}
?>
  </div>

</body>
</html>