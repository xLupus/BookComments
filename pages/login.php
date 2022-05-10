<?php include '../php/applica-control.php';?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/styles/css/login-cadastro.css">
</head>
<body>
    <div class="center">
        <div class="left-img-login"></div><!-- left -->

        <div class="right">
            <img src="../assets/images/Logo.svg" alt="Book BookComments">
            
            <div class="right-content">
                <p id="boas-vindas">Bem-vindo de volta ao <u>Book Comments</u>!</p>
                <h1>Acesse sua conta</h1>

                <form action="../php/login-user.php" method="POST">
                    
                    <div class="input-container">
                        <label for="email" <?=$warningColorText ?? ''?> >Email</label>
                        <input type="email" name="email" id="email" placeholder="Digite seu E-mail" <?=$warningBox ?? ''?>>
                    </div><!-- input-container -->

                    <div class="input-container">
                        <label for="senha" <?=$warningColorText ?? ''?> >Senha</label>
                        <input type="password" name="senha" id="senha" placeholder="Digite sua senha" <?=$warningBox ?? ''?>>
                        <i class="fa-solid fa-eye-slash"></i>
                    </div><!-- input-container -->

                    <?=$warningText ?? ''?>
                    
                    <input type="submit" value="Entrar" id="login">
                </form><!-- from -->

                
                <a href=" <?=$redirectLink ?? 'cadastrar.php'?>"><button id="link-btn">Registrar-se</button></a>
            </div><!-- right-content -->
        </div><!-- right -->
    </div><!-- center -->

    <script src="../js/functions.js"></script>
    <script src="https://kit.fontawesome.com/d4e28784cb.js" crossorigin="anonymous"></script>
</body>
</html>