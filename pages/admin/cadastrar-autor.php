<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Autor</title>
    <link rel="stylesheet" href="../../assets/styles/css/admin-area.css">
</head>
<body>
    <section class='registrar-autor'> <!-- mudar registrar para cadastrar -->
        <h1>Cadastrar - Autor</h1>
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
        <div class="autor-inputs">
            <form action="../../php/admin/validar-autor.php" method='POST' enctype='multipart/form-data'>

                <div class="inputs">
                    <div class="left">
                        <div class='img-container' <?=!empty($erros['IMAGEM'])?'class="box-error"':""?>>
                            <img id="img-preview" src="" alt="" >
                        </div>

                        <label for="img-input">Adicionar foto</label>
                        <input type="file" name="imagem" id="img-input">
                    </div><!-- left -->

                    <div class="right">
                        <input type="text" name="nome" id="" placeholder='Nome do Autor' <?=(!empty($erros['AUTOR']) && isset($nome))?"class='box-error'": "value='$nome'"?>>
                        
                        <textarea name="sobre" id="" cols="30" rows="10" placeholder='Sobre o autor...' <?=!empty($erros['SOBRE']) ?"class='box-error'": ""?>><?=empty($erros['SOBRE'])?$sobre:""?></textarea>
                    </div><!-- right -->
                </div><!-- inputs -->

                <input type="submit" value="Cadastrar" name="btn_cadastrar">
            </form>

        </div><!-- autor-inputs -->
    </section><!-- cadastrar-livro -->
    
    <script src="../../js/admin.js"></script>
</body>
</html>