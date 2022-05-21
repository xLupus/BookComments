<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/styles/css/galeria.css">
    <title>Autores</title>

</head>
<body>
    
    <div class="container-1280">
        <?php
            while($autor = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo "
                    <div class='autor-link'>
                        <a href='pag-autor.php?idAutor={$autor['idAutor']}'><img src='{$autor['foto']}' alt='{$autor['nome']}' width='300px'></a>
                        <span>{$autor['nome']}</span>
                    </div>
                ";
            }
        ?>
    </div>

</body>
</html>