<link rel="stylesheet" href="../assets/styles/css/galeria.css">

    <section class="banner">
        <div class="img-banner">
        </div><!-- img-banner -->
    </section><!-- banner -->


    <div class="container-1280">
        <div class="livros-destaque">
            <h3 class="titulo-livro-destaque">Livros da Semana</h3>

            <div class="galeria-livro">
                <?php while($livros = $livrosDestaque->fetch(PDO::FETCH_ASSOC)){ ?>
                        <div class='livro-link'>
                            <a href='php/user/pag-livro.php?idLivro=<?=$livros['idLivro'];?>'>
                                <img src='<?=$livros['capa']?>' alt='<?=$livros['titulo']?>' width='300px'>
                            </a>
                            <span><?=$livros['titulo']?></span>
                        </div> <!-- livro-link -->
                 <?php }?>
            </div><!-- galeria-livro -->
        </div><!-- livros-destaque -->

        <div class="autores-destaque">
            <h3 class="titulo-autor-destaque">Autores da Semana</h3>

            <div class="galeria-autor">
                <?php while($autor = $autoresDestaque->fetch(PDO::FETCH_ASSOC)){ ?>
                        <div class='autor-link'>
                            <a href='php/user/pag-autor.php?idAutor=<?=$autor['idAutor']?>'><img src='<?=$autor['foto']?>' alt='<?=$autor['nome']?>' width='300px'></a>
                            <span><?=$autor['nome']?></span>
                        </div> <!-- autor-link -->
                <?php } ?>
            </div><!-- galeria-autor -->
        </div><!-- autores-ddestaque  -->
    </div><!-- cointainer-1280 -->
