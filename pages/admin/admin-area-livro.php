<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Area</title>
    <link rel="stylesheet" href="../../assets/styles/css/admin-livros.css">

</head>
<body>

    <section class="container-1280">

        <form method="GET" class='search'>

            <div class="input-search">
                <label>Livro</label>
                <input type="text" name="busca" autofocus value="<?=$pesquisarLivro ?? ''?>">
            </div>

            <div class="input-search">
                <label>Autor</label>
                <input type="text" name="buscaAutor" value="<?=$pesquisarAutor ?? ''?>">
            </div>

            <div class="input-search">
                <label>Status</label>
                <select name="status">
                    <option value="">Ativa/Inativa</option>
                    <option value="s" <?=isset($filtroStatus) && $filtroStatus == 's' ? 'selected' : '' ?>>Ativa</option>
                    <option value="n" <?= isset($filtroStatus) && $filtroStatus == 'n' ? 'selected' : '' ?>>Inativa</option>
                </select>
            </div>

            <button type="submit">Filtrar</button>
        </form>

        <a href="../../php/admin/validar-livro.php"><button>+ Livros</button></a>


        <form method='GET' class='edit-form'>
            <table border='1' class="table-livro">
                <thead>
                    <tr>
                        <th>ID</th> <th>Capa</th> <th>Titulo</th> <th>Autor</th> <th>Status</th> <th>Ações</th>
                    </tr>
                </thead>
                <tbody>

            <?php while($livros = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>

                <tr>
                    <th><?=$livros['idLivro']?></th>

                    <td><img src='<?=$livros['capa']?>' alt='<?=$livros['titulo']?>' width='150px' height='200px'></td>

                    <td><?=$livros['titulo']?></td>

                    <td><?=$livros['nome']?></td>

                    <td><?=$livros['situacao']?></td>

                    <td><button type='submit' formaction='../admin/atualizar-livro.php' name='id' value='<?=$livros['idLivro']?>'>Editar</button></td>
                </tr>

            <?php } ?>
                </tbody>
            </table>
        </form>

            <?php 
                //verifica a pagina anterior e posterior
                $pagina_anterior = $pagina - 1;
                $pagina_posterior = $pagina + 1;
            ?>

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
    </section>
</body>
</html>