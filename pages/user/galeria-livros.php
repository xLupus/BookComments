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
        <?php
            while($livros = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo "
                    <div class='livro-link'>
                        <a href='pag-livro.php?idLivro={$livros['idLivro']}'><img src='{$livros['capa']}' alt='{$livros['titulo']}' width='300px'></a>
                        <span>{$livros['titulo']}</span>
                    </div>
                ";
            }
        ?>
    </div>
    
</body>
</html>