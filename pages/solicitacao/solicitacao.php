<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ALOCATEC</title>
  <link rel="stylesheet" href="solicitacao.css">
</head>
<body>

  <aside>
    <div>
      <div class="logo">ALOCATEC</div>
      <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.2); margin: 10px 20px;">
      <nav>
        <ul>
          <li>Início</li>
          <li>Solicitações</li>
          <li>Instalações</li>
          <li>Notificações</li>
        </ul>
      </nav>
    </div>

    <div>
      <div class="user">
        <img src="https://via.placeholder.com/32" alt="user">
        <div>
          <div><strong>André Martins</strong></div>
          <div>Administrador</div>
        </div>
      </div>
      <div class="logout">Sair</div>
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


    <div class="solicitacao">
     <div class="solicitacao-body">
        <div class="topo-solicitacao">
        <div class="nome-espaco">
            <h2>Nome do espaço</h2>
        </div>
        <div class="status-solicitacao">
            <h2>Pendente</h2>
        </div>
        </div>
        
        <div class="detalhes-solicitacao">
            <div>
                <img src="./img/perfil.png">
                <h2>Nome da pessoa</h2>
            </div>
            <div>
                <img src="./img/calendario.png">
                <h2>Data da Solicitação</h2>
            </div>
            <div>
                <img src="./img/relogio.png">
               <h2>Hora da solicitação</h2>
            </div>
        </div> 
     </div>
    </div>

  </div>

</body>
</html>
