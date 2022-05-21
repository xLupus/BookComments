<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros</title>
    <link rel="stylesheet" href="../../assets/styles/css/pag-livro.css">
</head>
<body>

    <div class="container-1100">

        <div class="top">
            <div class="left">
                <img src="<?=$capa?>" alt="" width="300px">

            </div><!-- left -->

            <div class="right">
                <p class="book-element">Titulo em Portugues: <span class="book-info"><?=$titulo?></span></p>
                <p class="book-element">Autor(a): <span class="book-info"><?=$autor?></span></p>
                <p class="book-element">Ano da Edição: <span class="book-info"><?=$lancamento?></span></p>
                <p class="book-element">Edição: <span class="book-info"><?=$edicao?></span> Volume: <span class="book-info"><?=$volume?></span> </p>
                <p class="book-element">Numero de Paginas <span class="book-info"><?=$paginas?></span></p>

            </div><!-- right -->
        </div><!-- top -->

        <div class="bottom">
            <h2>Sinopse:</h2>
            <div class="sinopse"><?=$sinopse?></div>
        </div>


    </div>

    
    
</body>
</html>