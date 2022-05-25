<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../assets/styles/css/login-cadastro.css">
</head>
<body>
    <div class="center">
        <div class="left-img-login"></div><!-- left -->

        <div class="right">
            <img src="../../assets/images/Logo.svg" alt="BookComments">
            
            <div class="right-content">
                <p id="boas-vindas">Bem-vindo de volta ao <u>Book Comments</u>!</p>
                <h1>Acesse sua conta</h1>

                <form action="../../php/user/validar-login.php" method="POST">
                    
                    <div class="input-container">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Digite seu E-mail" <?=!empty($erros['EMAIL'])? "class='box-error'": "value='$email'"?>>
                    </div><!-- input-container -->

                    <div class="input-container">
                        <label for="senha" >Senha</label>
                        <input type="password" name="senha" id="senha" placeholder="Digite sua senha"<?=!empty($erros['SENHA'])? "class='box-error'": ''?>>
                        <i class="fa-solid fa-eye-slash"></i>
                    </div><!-- input-container -->


                    <?php
                        if(isset($erros) && !empty($erros) ){
                            echo "<div class='validation-error'>
                                    <ul>";

                            foreach ($erros as $campo => $erro) {
                                echo "<li>$erro $campo </li>";
                            }

                            echo "  </ul>
                                </div>";
                        }
                    ?>
                    
                    <input type="submit" value="Entrar" id="login" name='btn_entrar'>
                </form><!-- from -->

                
                <a href="../../php/user/validar-cadastro.php"><button id="link-btn">Registrar-se</button></a>
            </div><!-- right-content -->
        </div><!-- right -->
    </div><!-- center -->

    <script src="../js/functions.js"></script>
    <script src="https://kit.fontawesome.com/d4e28784cb.js" crossorigin="anonymous"></script>
</body>
</html>