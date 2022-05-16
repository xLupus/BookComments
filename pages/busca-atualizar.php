<?php 
include '../php/includes/database-connection.php';

//Autor
$stmt = $database->query("SELECT idAutor, nome FROM BK_tbAutor");
$stmt->execute();

while($autores = $stmt->fetch(PDO::FETCH_ASSOC)){
    $idAutor[] = $autores['idAutor'];
    $nomeAutor[] = $autores['nome'];

}

//Livro
$stmt = $database->query("SELECT idLivro, titulo FROM BK_tbLivro");
$stmt->execute();

while($livros = $stmt->fetch(PDO::FETCH_ASSOC)){
    $idLivro[] = $livros['idLivro'];
    $nomeLivro[] = $livros['titulo'];

}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>




    <form method="GET" action="../php/atualizar-autor.php"> <!-- Autor -->
        <label for="autor">Autor(a)</label>
        <input list="autores" name="autor" id="autor">

        <datalist id="autores">
            <?php
            
            if(isset($nomeAutor) && !empty($nomeAutor)){
                for($i = 0; $i < count($nomeAutor); $i++){
                    echo "<option value='{$idAutor[$i]}'>{$nomeAutor[$i]}</option>";  
                }
            }else{
                echo '';
            }

            ?>
        </datalist>
        <button type="submit">Atualizar</button>
    </form>





    <form  action="../php/atualizar-livro.php" method="GET">   <!-- Livro  -->
        <label for="livro">Livro</label>
        <input list='livros' name="livro" id="livro">

        <datalist id="livros">
            <?php
                if(isset($nomeLivro) && !empty($nomeLivro)){
                    for($i = 0; $i < count($nomeLivro); $i++){
                        echo "<option value='{$idLivro[$i]}'>{$nomeLivro[$i]}</option>";  
                    }
                }else{
                    echo '';
                }
            ?>
        </datalist>
        <button type="submit">Atualizar</button>
    </form>





</body>
</html>