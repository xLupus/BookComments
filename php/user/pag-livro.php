<?php

include_once '../includes/database-connection.php';

$id = preg_replace("/\D/", '', $_GET['idLivro']);

$stmt = $database->prepare('SELECT BK_tbAutor.nome, BK_tbSinopse.sinopse, titulo, Capa, lancamento, edicao, volume, numPag, situacao
                            FROM BK_tbLivro
                            INNER JOIN BK_tbAutor on BK_tbAutor.idAutor = BK_tbLivro.idAutor
                            INNER JOIN BK_tbSinopse on BK_tbSinopse.idSinopse = BK_tbLivro.idSinopse
                            WHERE idLivro = :id');

$stmt->bindParam(':id',$id);
$stmt->execute();

$livro = $stmt->fetch(PDO::FETCH_ASSOC);

$capa = $livro['Capa'];
$titulo = $livro['titulo'];
$autor = $livro['nome'];
$lancamento = $livro['lancamento'];
$edicao = $livro['edicao'];
$volume = $livro['volume'];
$paginas = $livro['numPag'];
$sinopse = $livro['sinopse'];

include '../../pages/view/header.php';
include '../../pages/user/pag-livro.php';
include '../../pages/view/footer.php';