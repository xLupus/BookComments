<?php

include_once './includes/database-connection.php';

$stmt = $database->query("SELECT idLivro, titulo, capa
                          FROM BK_tbLivro
                          WHERE situacao = 's' ");

$stmt->execute();

include '../pages/galeria-livros.php';