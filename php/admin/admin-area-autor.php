<?php

include '../includes/database-connection.php';

//Pagina 'atual'
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

//SELECTIONA TOTOS OS RESULTADOS
$resultados = $database->query("SELECT qtd = count(*) FROM BK_tbAutor");
$resultados->execute();

$total_de_resultados = $resultados->fetch(PDO::FETCH_ASSOC);

//QUNATIDADE POR PAGINA
$qtd_por_pagina = 6;

//quantidade de paginas necessarias
$num_paginas = ceil($total_de_resultados['qtd'] / $qtd_por_pagina);

//Inicio da visualização
$inicio = $qtd_por_pagina * $pagina - $qtd_por_pagina;



$pesquisar = isset($_GET['busca']) ? htmlspecialchars($_GET['busca'], ENT_COMPAT, 'UTF-8') : "";

$condicoes = [strlen($pesquisar) ? "nome LIKE '%".str_replace(' ', '%',$pesquisar)."%'": null];
$condicoes = array_filter($condicoes);

$where = empty($condicoes) ? '': 'WHERE '. implode(' AND ', $condicoes); 

$order = " ORDER BY idAutor";

//Seleciona os itens a serem apresentados
$stmt = $database->query("SELECT idAutor, nome 
                          FROM BK_tbAutor
                          $where $order
                          OFFSET $inicio ROWS
                          FETCH NEXT $qtd_por_pagina ROWS ONLY");

$stmt->execute();


include '../../pages/view/header.php';
include '../../pages/admin/admin-area-autor.php';
include '../../pages/view/footer.php';