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
        <div class="filter-autor">
            <h1>Autores</h1>
            <select name="ordem" >
                <option value="">Filtro</option>
                <option value="">A-z</option>    
                <option value="">Z-a</option>
                <option value="">Mais Recentes</option>
                <option value="">Menos Recentes</option>
            <select>
        </div>

        <div class="galeria-autor">
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

    </div>

</body>
</html>