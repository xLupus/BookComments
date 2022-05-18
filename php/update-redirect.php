<?php

include './includes/database-connection.php';

var_dump($_GET);

if(isset($_GET['livro']) && !empty($_GET['livro'])){

    $stmt = $database->prepare("SELECT idAutor, BK_tbSinopse.sinopse, titulo, capa, lancamento, edicao, volume, numPag, situacao 
                                FROM BK_tbLivro 
                                INNER JOIN BK_tbSinopse on BK_tbSinopse.idSinopse = BK_tbLivro.idSinopse
                                WHERE idLivro = :id");

    $stmt->bindParam(':id', $idLivro);
    $stmt->execute();
    $livroContent = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$livroContent){

    }

}else{
    echo "
        <script>
            alert('Livro invalido')
            window.history.go(-1)
        </script>
    ";
}
