<?php

include_once '../includes/database-connection.php';

$id = preg_replace("/\D/", '', $_GET['idAutor']);


/*
SELECT nome, sobre, foto, BK_tbLivro.titulo, BK_tbLivro.Capa, BK_tbLivro.idLivro
FROM BK_tbAutor 
INNER JOIN BK_tbLivro on BK_tbLivro.idAutor = BK_tbAutor.idAutor
WHERE BK_tbAutor.idAutor = 4
*/

$stmt = $database->prepare('SELECT nome, sobre, foto
                            FROM BK_tbAutor
                            WHERE idAutor = :id');

$stmt->bindParam(':id', $id);
$stmt->execute();

$autor = $stmt->fetch(PDO::FETCH_ASSOC);

$nomeAutor = $autor['nome'];
$sobreAutor = $autor['sobre'];
$fotoAutor = $autor['foto'];

/*
SELECT titulo, Capa
FROM BK_tbLivro
INNER JOIN BK_tbAutor on BK_tbAutor.idAutor = BK_tbLivro.idAutor
WHERE BK_tbAutor.idAutor = 4
*/



include '../../pages/view/header.php';
include '../../pages/user/pag-autor.php';
include '../../pages/view/footer.php';