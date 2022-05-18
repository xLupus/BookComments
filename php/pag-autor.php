<?php

include_once './includes/database-connection.php';

$id = preg_replace("/\D/", '', $_GET['idAutor']);

$stmt = $database->prepare('SELECT nome, sobre, foto
                            FROM BK_tbAutor
                            WHERE idAutor = :id');

$stmt->bindParam(':id', $id);
$stmt->execute();

$autor = $stmt->fetch(PDO::FETCH_ASSOC);

$nomeAutor = $autor['nome'];
$sobreAutor = $autor['sobre'];
$fotoAutor = $autor['foto'];


include '../pages/pag-autor.php';