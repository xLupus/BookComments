<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Livro</title>
    <link rel="stylesheet" href="../assets/styles/css/admin-area1.css">
</head>
<body>
    <section class="cadastrar-livro">
        <h1>Cadastrar - Livro</h1>
        <hr>
        <?php
            if(isset($confirmation)){
                echo $confirmation;

            }elseif(isset($erros) && !empty($erros) ){
                echo "<div class='validation-error'>
                        <ul>";

                foreach ($erros as $campo => $erro) {
                    echo "<li>$erro $campo </li>";
                }

                echo "  </ul>
                    </div>";
            }
        ?>
        <div class="livro-inputs">
            <form action="../php/validar-livro.php" method='POST' enctype='multipart/form-data'>
                <div class="inputs">
                    <div class="left">
                        <div class='img-container'>
                            <img id="img-preview" src="" >
                        </div>

                        <label for="img-input" <?=!empty($erros['IMAGEM'])?"class='box-error'": ''?>>Adicionar foto</label>
                        <input type="file" name="imagem" id="img-input" >
                    </div><!-- left -->

                    <div class="right">
                        <div class="campo-input">
                            <label for="titulo">Titulo em Portugues</label>
                            <input type="text" name="titulo" id="titulo"<?=!empty($erros['TITULO'])? "class='box-error'": "value='$titulo'"?>>
                        </div>

                        <div class="campo-input">
                            <label for="autor">Autor(a)</label>
                            <input type="text" name="autor" id="autor">
                        </div>

                        <div class='row'>
                            <div class="campo-input">
                                <label for="lancamento">Lançamento</label>
                                <input type="number" name="lancamento" id="lancamento" <?=!empty($erros['LANCAMENTO']) ? "class='box-error'": "value='$lancamento'"?>>
                            </div>
    
                            <div class="campo-input">
                                <label for="edicao">Edição</label>
                                <input type="number" name="edicao" id="edicao" <?=!empty($erros['EDICAO'])?"class='box-error'":"value='$edicao'"?>>
                            </div>
    
                            <div class="campo-input">
                                <label for="volume">Volume</label>
                                <input type="number" name="volume" id="volume"<?=!empty($erros['VOLUME'])?"class='box-error'": "value='$volume'"?>>
                            </div>
                        </div><!-- row -->

                        <div class="row">
                            <div class="campo-input">
                                <label for="paginas">Paginas</label>
                                <input type="number" name="paginas" id="paginas"<?=!empty($erros['PAGINAS']) ?"class='box-error'": "value='$paginas'"?>>
                            </div>
    
                            <div id='status'>
                                <p>Ativo:</p>
                                <label for="ativado">Sim</label>
                                <input type="radio" name="situacao" id="ativado" value="1" checked>
                                <label for="desativado">Não</label>
                                <input type="radio" name="situacao" id="desativado" value="0">
                            </div>
                        </div><!-- row -->

                        <div class="campo-input">
                        <label for="sinopse" id='sinopse-label'>Sinopse</label>
                        <textarea name="sinopse" id="sinopse" cols="30" rows="10" placeholder="Era uma vez..." <?=!empty($erros['SINOPSE'])?"class='box-error'": "value='$sinopse'"?>></textarea>
                        </div>
                    </div><!-- right -->             
                </div><!-- inputs -->



                <input type="submit" value="Cadastrar" name='btn_cadastrar'>
            </form>

        </div><!-- autor-inputs -->
    </section><!-- cadastrar-livro -->
    <script src="../js/admin.js"></script>
</body>
</html>