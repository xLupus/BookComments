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
        <div class="filter-row">
            <h2>Livros</h2>

            <div class="filter-dropdown">
                <button class="dropbtn">FILTRO</button>
            
                <div class="filter-dropdown-content">
                    <a href="?ordem=Az">Ordem (A-z)</a>
                    <a href="?ordem=Za">Ordem (Z-a)</a>
                    <a href="?ordem=MaisNovos">Mais Recentes</a>
                    <a href="?ordem=MaisAntigos">Menos Recentes</a>
                </div><!-- filter-dropdown-content -->
            </div><!-- filter-dropdown -->
        </div><!-- filter-row -->

        <div class="galeria-livro">
            <?php while($livros = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
                    <div class='livro-link'>
                        <a href='pag-livro.php?idLivro=<?=$livros['idLivro']?>'>
                            <img src='<?=$livros['capa']?>' alt='<?=$livros['titulo']?>' width='300px' >
                        </a>
                        <span class="titulo-livro"><?=$livros['titulo']?></span>
                    </div>
                <?php } ?>
        </div><!-- galeria-livro -->
        <?php 
            //verifica a pagina anterior e posterior
            $pagina_anterior = $pagina - 1;
            $pagina_posterior = $pagina + 1;
        ?>

        <div class="pagination-container">
            <div class="pagination">
                <?php if($pagina_anterior != 0) { ?>
                    <a href="?pagina=<?=$pagina_anterior;?>">&laquo;</a>
                <?php }else{ ?>
                    <span>&laquo;</span>
                <?php } ?>

                <?php for($i = 1; $i < $num_paginas + 1; $i++ ) {?>
                    <a href="?pagina=<?=$i;?>"><?=$i;?></a>
                <?php }?>
                
                <?php if($pagina_posterior <= $num_paginas) { ?>
                    <a href="?pagina=<?=$pagina_posterior;?>">&raquo;</a>
                <?php }else{ ?>
                    <span>&raquo;</span>
                <?php } ?>
            </div><!-- pagination -->
        </div>
    </div><!-- container-1280 -->
</body>
</html>