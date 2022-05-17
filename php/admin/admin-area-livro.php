<?php

include '../includes/database-connection.php';
include '../functions/function.php';


$pesquisar = isset($_GET['busca']) ? htmlspecialchars($_GET['busca'], ENT_COMPAT, 'UTF-8') : "";

$filtroStatus = isset($_GET['status']) ? htmlspecialchars($_GET['status'], ENT_COMPAT, 'UTF-8') : "";
$filtroStatus = in_array($filtroStatus,['s','n']) ? $filtroStatus : "";

$condicoes = [
    strlen($pesquisar) ? "titulo LIKE '%".str_replace(' ', '%',$pesquisar)."%'".
    " OR nome LIKE'%".str_replace(' ', '%',$pesquisar)."%'" : null,
    
    strlen($filtroStatus) ? "situacao = '".$filtroStatus."'" : null
];

$condicoes = array_filter($condicoes);

$where = empty($condicoes) ? '': 'WHERE '. implode(' AND ', $condicoes); 

$order = " ORDER BY titulo";


include '../../pages/admin/admin-area-livro.php';