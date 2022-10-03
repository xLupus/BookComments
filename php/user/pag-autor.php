<?php

include_once '../includes/database-connection.php';

$id = preg_replace("/\D/", '', $_GET['idAutor']);

//AUTOR
$stmt = $database->prepare('SELECT nome, sobre, foto
                            FROM BK_tbAutor 
                            WHERE idAutor = :id');

$stmt->bindParam(':id', $id);
$stmt->execute();

$autor      = $stmt->fetch(PDO::FETCH_ASSOC);
$nomeAutor  = $autor['nome'];
$sobreAutor = $autor['sobre'];
$fotoAutor  = $autor['foto'];

//LIVROS DO AUTOR
$stmtLivro = $database->prepare('SELECT BK_tbLivro.Capa,BK_tbLivro.titulo,BK_tbLivro.idLivro
                                 FROM BK_tbLivro
                                 INNER JOIN BK_tbAutor ON BK_tbAutor.idAutor = BK_tbLivro.idAutor
                                 WHERE BK_tbAutor.idAutor = :id');

$stmtLivro->bindParam(':id', $id);
$stmtLivro->execute();

while($livroAutor  = $stmtLivro->fetch(PDO::FETCH_ASSOC)){
    $capaLivro[]   = $livroAutor['Capa'];
    $tituloLivro[] = $livroAutor['titulo'];
    $idLivro[]     = $livroAutor['idLivro'];
}

include '../../pages/view/header.php';
include '../../pages/user/pag-autor.php';
include '../../pages/view/footer.php';
