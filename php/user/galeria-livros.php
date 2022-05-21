<?php

include_once '../includes/database-connection.php';


$total = $database->query("SELECT total = count(*) FROM BK_tbLivro WHERE situacao = 's'");
$total->execute();
/*
PAGINACAO
$resultados = $total->fetch(PDO::FETCH_ASSOC);
$resultados = $resultados;

$limitPerPagina = 5;
$pages = $resultados > 0 ? ceil($resultados / $limitPerPagina) : 1;

var_dump($resultados);

$currentPage = $_GET['pagina'] ?? null;

if(is_numeric($currentPage) and $currentPage > 0){
    $currentPage = 1;
}

if($currentPage <= $pages){
    $currentPage = $currentPage;

}else{
    $currentPage = $pages;
}




//var_dump($resultados);
*/

$pesquisa = isset($_GET['pesquisa']) ? htmlspecialchars($_GET['pesquisa'], ENT_COMPAT, 'UTF-8') : "";

$condicoes = [strlen($pesquisa) ? "titulo LIKE '%".str_replace(' ', '%',$pesquisa)."%'" : null,
             "situacao = 's'"]; 

$condicoes = array_filter($condicoes);

$where = empty($condicoes) ? '': 'WHERE '. implode(' AND ', $condicoes); 

$stmt = $database->query("SELECT idLivro, titulo, capa
                          FROM BK_tbLivro
                          $where ");

$stmt->execute();

include '../../pages/view/header.php';
include '../../pages/user/galeria-livros.php';
include '../../pages/view/footer.php';