<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autor</title>
    <link rel="stylesheet" href="../../assets/styles/css/pag-autor.css">
</head>
<body>
    <div class="container-1280">

        <div class="top">

            <div class="left">
                <img src="<?=$fotoAutor?>" alt="" width="300px">
            </div><!-- left -->

            <div class="right">
                <p class="nome"><?=$nomeAutor?></p>

                <div class="sobre"><?=$sobreAutor?></div>
            </div><!-- right -->
        </div><!-- top -->

        <div class="bottom">
            <h3>Livros:</h3>

            <?php 
                if(!empty($tituloLivro)){
                    for($i = 0; $i < count($tituloLivro); $i++) {?>
                        <div class="livros-autor">
                            <a href="pag-livro.php?idLivro=<?=$idLivro[$i];?>"><img src="<?=$capaLivro[$i];?>" alt="" width="200px" height="280px"></a>
                            <p><?=$tituloLivro[$i];?></p>
                        </div><!-- livros-autor -->
            <?php   }
                }else 
                    echo "<p>Nenhum Livro Cadastrado</p>";

            ?>
        </div><!-- bottom -->
    </div><!-- container-1280 -->

</body>
</html>