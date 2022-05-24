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

    <section class="container-900">

        <form method="GET" class="search">
            <div class="input-search">
                <label>Autor</label>
                <input type="text" name="busca" autofocus value="<?=$pesquisar ?? ''?>">
            </div>

            <button type="submit">Filtrar</button>
        </form>

        <a href="../../php/admin/validar-autor.php"><button>+ Autor</button></a>

        <form method='GET'>
            <table border='1' class="table-autor">
                <tr>
                    <th>ID</th> <th>Autor</th> <th>Ações</th>
                </tr>
            <?php while($autores = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>

                <tr>
                    <td><?=$autores['idAutor']?></td>

                    <td><?=$autores['nome']?></td>

                    <td><button type='submit' formaction='../admin/atualizar-autor.php' name='id' value='<?=$autores['idAutor']?>'>Editar</button></td>
                </tr>

            <?php } ?>
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