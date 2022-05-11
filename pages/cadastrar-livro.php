<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Livro</title>
    <link rel="stylesheet" href="../assets/styles/css/admin-area.css">
</head>
<body>
    <section class="cadastrar-livro">
        <h1>Cadastrar - Livro</h1>
        <hr>

        <!-- <div class="validation-ok"><p>Autor cadastrado com sucesso</p></div>  -->

        <div class="livro-inputs">
            <form action="../php/validar-livro.php" method='POST' enctype='multipart/form-data'>
                <div class="inputs">
                    <div class="left">
                        <div class='img-container'>
                            <img id="img-preview" src="" >
                        </div>

                        <label for="img-input">Adicionar foto</label>
                        <input type="file" name="imagem" id="img-input">
                    </div><!-- left -->

                    <div class="right">
                        <div class="campo-input">
                            <label for="titulo">Titulo em Portugues</label>
                            <input type="text" name="titulo" id="titulo">
                        </div>

                        <div class="campo-input">
                            <label for="autor">Autor(a)</label>
                            <input type="text" name="autor" id="autor">
                        </div>

                        <div class="campo-input">
                            <label for="lancamento">Ano de ----</label>
                            <input type="number" name="lancamento" id="lancamento">
                        </div>

                        <div class="campo-input">
                            <label for="edicao">Edição</label>
                            <input type="number" name="edicao" id="edicao">
                        </div>

                        <div class="campo-input">
                            <label for="volume">Volume</label>
                            <input type="number" name="volume" id="volume">
                        </div>

                        <div class="campo-input">
                            <label for="paginas">Paginas</label>
                            <input type="number" name="paginas" id="paginas">
                        </div>

                        <div class="campo-input">
                            <p>Ativo:</p>
                            <label for="ativado">Sim</label>
                            <input type="radio" name="situacao" id="ativado" value="1">
                            <label for="desativado">Não</label>
                            <input type="radio" name="situacao" id="desativado" value="0">
                        </div>
                    </div><!-- right -->             
                </div><!-- inputs -->

                <div class="campo-input">
                        <label for="sinopse">Sinopse</label>
                        <textarea name="sinopse" id="sinopse" cols="30" rows="10" placeholder="Era uma vez..."></textarea>
                </div>

                <input type="submit" value="Cadastrar">
            </form>

        </div><!-- autor-inputs -->
    </section><!-- cadastrar-livro -->
</body>
</html>