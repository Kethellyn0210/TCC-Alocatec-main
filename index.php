<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
 
    <title>Alocatec - Login</title>
</head>
 
<body>
    <div class="container">
        <form class="login-form" method="post" action="validacao_adm.php">
            <div class="form-header">
                <img src="https://placehold.co/180x180">
            </div>
 
            <div class="form-content">
                <label>Email</label>
                <input class="form-control" placeholder="E-mail" name="email" />
             
                <label>Senha</label>
                <input class="form-control" placeholder="Senha" name="senha" />
               
                <button class="btn">Entrar</button>        
            </div>
        </form>
    </div>
</body>
</html>