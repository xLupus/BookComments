<?php

include '../includes/database-connection.php';
include '../functions/function.php';

$pesquisar = isset($_GET['busca']) ? htmlspecialchars($_GET['busca'], ENT_COMPAT, 'UTF-8') : "";

$condicoes = [strlen($pesquisar) ? "nome LIKE '%".str_replace(' ', '%',$pesquisar)."%'": null];
$condicoes = array_filter($condicoes);

$where = empty($condicoes) ? '': 'WHERE '. implode(' AND ', $condicoes); 

$order = " ORDER BY nome";


include '../../pages/admin/admin-area-autor.php';