<?php

include '../includes/database-connection.php';

$pesquisarLivro = isset($_GET['busca']) ? htmlspecialchars($_GET['busca'], ENT_COMPAT, 'UTF-8') : "";
$pesquisarAutor = isset($_GET['buscaAutor']) ? htmlspecialchars($_GET['buscaAutor'], ENT_COMPAT, 'UTF-8') : "";

$filtroStatus = isset($_GET['status']) ? htmlspecialchars($_GET['status'], ENT_COMPAT, 'UTF-8') : "";
$filtroStatus = in_array($filtroStatus,['s','n']) ? $filtroStatus : "";

$condicoes = [
    strlen($pesquisarLivro) ? "titulo LIKE '%".str_replace(' ', '%',$pesquisarLivro)."%'" : null,
    strlen($pesquisarAutor) ? "nome LIKE '%".str_replace(' ', '%', $pesquisarAutor)."%'" : null,
    strlen($filtroStatus) ? "situacao = '".$filtroStatus."'" : null
];

$condicoes = array_filter($condicoes);
$where = empty($condicoes) ? '': 'WHERE '. implode(' AND ', $condicoes); 


$stmt = $database->query("SELECT idLivro, BK_tbAutor.nome, titulo, capa, situacao =
                          CASE WHEN situacao = 's' THEN 'Ativo' 
                          WHEN situacao = 'n' THEN 'Inativo'
                          END 
                          FROM BK_tbLivro
                          INNER JOIN BK_tbAutor 
                          ON BK_tbAutor.idAutor = BK_tbLivro.idAutor
                          $where ORDER BY titulo");

$stmt->execute();
include '../../pages/view/header.php';
include '../../pages/admin/admin-area-livro.php';
include '../../pages/view/footer.php';