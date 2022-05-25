<?php 
require 'php/includes/access-control.php';
require 'php/includes/database-connection.php';

$livrosDestaque = $database->query("SELECT TOP 5 idLivro, titulo, capa
                                    FROM BK_tbLivro
                                    WHERE situacao = 's'");

$livrosDestaque->execute();

$autoresDestaque = $database->query("SELECT TOP 5 idAutor, nome, foto
                                     FROM BK_tbAutor
                                     WHERE idAutor != 1");

$autoresDestaque->execute();

include './pages/view/header.php';
include './pages/index.php';
include './pages/view/footer.php';
?>