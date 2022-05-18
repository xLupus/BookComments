<?php

include_once './includes/database-connection.php';

$stmt = $database->query('SELECT idAutor, nome, foto
                          FROM BK_tbAutor');
$stmt->execute();




include '../pages/galeria-autores.php';