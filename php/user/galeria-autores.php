<?php

include_once '../includes/database-connection.php';

$pesquisa = isset($_GET['pesquisa']) ? htmlspecialchars($_GET['pesquisa'], ENT_COMPAT, 'UTF-8') : "";

$condicoes = [strlen($pesquisa) ? "nome LIKE '%".str_replace(' ', '%',$pesquisa)."%'" : null,
             'idAutor != 1']; 

$condicoes = array_filter($condicoes);

$where = empty($condicoes) ? '': 'WHERE '. implode(' AND ', $condicoes); 

$stmt = $database->query("SELECT idAutor, nome, foto
                          FROM BK_tbAutor
                          $where");
$stmt->execute();

include '../../pages/view/header.php';
include '../../pages/user/galeria-autores.php';
include '../../pages/view/footer.php';