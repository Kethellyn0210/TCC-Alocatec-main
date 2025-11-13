<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../../../database/conexao_bd_mysql.php';

$id_estabelecimento = intval($_POST['id_estabelecimento']);
$id_espaco          = intval($_POST['id_espaco']);
$nome               = $_POST['nome'];
$tipo               = $_POST['tipo'];
$capacidade         = intval($_POST['capacidade']);
$cobertura          = $_POST['cobertura'];
$status             = $_POST['status'];
$inicio             = $_POST['inicio'];
$termino            = $_POST['termino'];
$disponibilidade    = $_POST['disponibilidade'];

$sql1 = "
UPDATE estabelecimento 
SET nome='$nome', inicio='$inicio', termino='$termino', disponibilidade='$disponibilidade', status='$status'
WHERE id_estabelecimento = $id_estabelecimento;
";

$sql2 = "
UPDATE espaco
SET tipo='$tipo', capacidade='$capacidade', cobertura='$cobertura'
WHERE id_espaco = $id_espaco;
";

if (mysqli_query($conexao_servidor_bd, $sql1) && mysqli_query($conexao_servidor_bd, $sql2)) {
    $_SESSION['mensagem'] = [
        'tipo' => 'sucesso',
        'texto' => 'Instalação atualizada com sucesso!'
    ];
} else {
    $_SESSION['mensagem'] = [
        'tipo' => 'erro',
        'texto' => 'Erro ao atualizar instalação: ' . mysqli_error($conexao_servidor_bd)
    ];
}

header("Location: ../../detalhes_instalacoes/instalacao.php?id_estabelecimento=$id_estabelecimento");
exit();
?>
