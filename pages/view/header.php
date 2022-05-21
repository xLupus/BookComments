<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookComments</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/styles/css/header.css">
    <link rel="stylesheet" href="../../assets/styles/css/footer_absolute.css">
    <link rel="stylesheet" href="../../assets/styles/css/index.css">
</head>
<body>

    <header>
        <div class="header-container">
        
            <div class="logo">
                <a href="../../index.php"><img src="../../assets/images/Logo.svg" alt="BookComments"></a>
            </div><!-- logo -->

            <nav>
                <ul>
                    <li><a href="../../php/user/galeria-autores.php">Autores</a></li>
                    <li><a href="../../php/user/galeria-livros.php">Livros</a></li>
                </ul>
            </nav>

            <form action="">
                <select name="" id="">
                    <option value="Livros">Livro</option>
                    <option value="Autores">Autor</option>
                </select>

                <input type="search" name="pesquisa" id="pesquisa">

                <input type="submit" value="Pesquisar">
            </form>

          <div class="dropdown">
                <button class="btn btn-secondary " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Perfil
                </button>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="../../php/admin/admin-area-livro.php">Livros</a></li>
                    <li><a class="dropdown-item" href="../../php/admin/admin-area-autor.php">Autores</a></li>
                    <li><a class="dropdown-item" href="#">Sair</a></li>
                </ul>
            </div><!-- dropdown -->

        </div><!-- header-container -->
    </header>

        




    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>
</html>