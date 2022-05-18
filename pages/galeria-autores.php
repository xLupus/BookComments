<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autores</title>
</head>
<body>
    
    <div>
        <?php
            while($autor = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo "
                    <div>
                        <a href='pag-autor.php?idAutor={$autor['idAutor']}'><img src='{$autor['foto']}' alt='{$autor['nome']}' width='300px'></a>
                        <span>{$autor['nome']}</span>
                    </div>
                ";
            }
        ?>
    </div>

</body>
</html>