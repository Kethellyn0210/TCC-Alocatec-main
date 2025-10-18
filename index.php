<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALOCATEC - Login</title>
    <link rel="stylesheet" href="./index.css">
</head>
<body>
    <div class="fundo">
        <img src="./img/foto_login.jpeg" alt="">
        <div class="caixa-login">
            <div class="logo">
                <img src="./img/alocatec_logo.jpeg" alt="Logo" class="icone-logo">
                <h2 class="nome-logo">ALOCATEC</h2>
            </div>

            <form class="formulario">
                <label for="nome" class="rotulo">Nome</label>
                <input type="text" id="nome" class="campo-texto" placeholder="Digite seu nome">

                <label for="senha" class="rotulo">Senha</label>
                <input type="password" id="senha" class="campo-texto" placeholder="Digite sua senha">

                <a href="#" class="link-cadastro">Cadastre-se</a>
             
                <button type="submit" class="botao-entrar"> <a href="./pages/home/home.php">Entrar</a></button>
               
            </form>
        </div>
    </div>
</body>
</html>