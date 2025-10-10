<?php

if($_POST)
{
    $usuario = strtoupper($_POST['email']);
    $senha = strtoupper($_POST['senha']);

    $situacao_usuario = false;
    
        if($usuario == "ADMIN" && $senha == "1234")
        {
            $situacao_usuario = true;
        }
        else
        {
            header("Location:index.php?erro_login=true");        
        }
    
    if($situacao_usuario == true)
    {
        header("Location:pages/home/home.php");
    }
}      