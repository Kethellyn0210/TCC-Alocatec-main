<?php

$local_servidor = "localhost:3307";
$usuario = "root";
$senha = "";

$bd_procurado = "bd_sra_3ds_ermelinda";

$conexao_servidor_bd = 
mysqli_connect($local_servidor, $usuario, $senha,  $bd_procurado);
                      
?>
