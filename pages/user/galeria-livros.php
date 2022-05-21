<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/styles/css/galeria.css">
    <title>Livros</title>
</head>
<body>

    <div class="container-1280">
        <div class="filter-book">
            <h1>Livros</h1>

            <select name="ordem" >
                <option value="">Filtro</option>
                <option value="">A-z</option>    
                <option value="">Z-a</option>
                <option value="">Mais Recentes</option>
                <option value="">Menos Recentes</option>
            <select>


        </div><!-- filter-book -->

        <div class="galeria-livro">
            <?php
                while($livros = $stmt->fetch(PDO::FETCH_ASSOC)){
                    echo "
                        <div class='livro-link'>
                            <a href='pag-livro.php?idLivro={$livros['idLivro']}'>
                                <img src='{$livros['capa']}' alt='{$livros['titulo']}' width='300px' >
                            </a>
                            <span>{$livros['titulo']}</span>
                        </div>
                    ";
                }
            ?>
        </div><!-- galeria-livro -->

    </div><!-- container-1280 -->
</body>
</html>