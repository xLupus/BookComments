<?php require 'php/includes/access-control.php';?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/css/style.css">
    <link rel=”stylesheet” href=”https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css”>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <title>BookComments</title>
</head>

<body>
<section class="header">
        <nav class="menu">
            <ul class="menu__list">
                <li class="menu__links"><a href="index.php" class="menu__link"><img src="assets/images/logo.png" alt="Logo" class="header__img"></a></li>
                <li class="menu__links"><a href="php/validar-livro.php" class="menu__link">Livros</a></li>
                <li class="menu__links"><a href="php/validar-autor.php" class="menu__link">Autores</a></li>
                <li class="menu__links">
                    <div class="search">
                        <form action="#"class="form">
                            <input type="text"
                            placeholder=" Buscar"
                            name="search">
                            <button class="menu__botao">
                                Buscar
                            </button>
                        </form>
                    </div>
                </li>
                <li class="menu__links"><a href="php/includes/logout.php" class="menu__link" id="login">Sair</a></li>
            </ul>
        </nav>
</section>

<main class="main">
    <section class="main__content">    
        <div class="main__banner">
            <img src="assets/images/banner.png"> 
        </div>
    </section>
</main>

<footer class="footer">
    <p class="footer__txt"> <a class="footer__title"> BookComments </a> <img src="assets/images/footer-logo.png" alt="Footer__logo" class="footer__logo" /></p>
</footer>


</body>
</html>