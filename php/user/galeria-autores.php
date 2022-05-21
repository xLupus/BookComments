<?php

include_once '../includes/database-connection.php';

$stmt = $database->query('SELECT idAutor, nome, foto
                          FROM BK_tbAutor
                          WHERE idAutor != 1');
$stmt->execute();

include '../../pages/view/header.php';
include '../../pages/user/galeria-autores.php';
include '../../pages/view/footer.php';