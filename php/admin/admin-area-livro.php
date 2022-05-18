<?php

include '../includes/database-connection.php';
include '../functions/function.php';


$pesquisarLivro = isset($_GET['busca']) ? htmlspecialchars($_GET['busca'], ENT_COMPAT, 'UTF-8') : "";

$pesquisarAutor = isset($_GET['buscaAutor']) ? htmlspecialchars($_GET['buscaAutor'], ENT_COMPAT, 'UTF-8') : "";

var_dump($pesquisarAutor);

$filtroStatus = isset($_GET['status']) ? htmlspecialchars($_GET['status'], ENT_COMPAT, 'UTF-8') : "";
$filtroStatus = in_array($filtroStatus,['s','n']) ? $filtroStatus : "";

$condicoes = [
    strlen($pesquisarLivro) ? "titulo LIKE '%".str_replace(' ', '%',$pesquisarLivro)."%'" : null,
    strlen($pesquisarAutor) ? "nome LIKE '%".str_replace(' ', '%', $pesquisarAutor)."%'" : null,
    strlen($filtroStatus) ? "situacao = '".$filtroStatus."'" : null
];

$condicoes = array_filter($condicoes);

$where = empty($condicoes) ? '': 'WHERE '. implode(' AND ', $condicoes); 

var_dump($where);
$order = " ORDER BY titulo";


include '../../pages/admin/admin-area-livro.php';