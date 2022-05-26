<?php

include_once '../includes/database-connection.php';

$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

//SELECTIONA TOTOS OS RESULTADOS
$resultados = $database->query("SELECT qtd = count(*)
                                FROM BK_tbLivro
                                WHERE situacao = 's'");
$resultados->execute();

$total_de_resultados = $resultados->fetch(PDO::FETCH_ASSOC);

//QUNATIDADE POR PAGINA
$qtd_por_pagina = 15;

//quantidade de paginas necessarias
$num_paginas = ceil($total_de_resultados['qtd'] / $qtd_por_pagina);

//Inicio da visualização
$inicio = $qtd_por_pagina * $pagina - $qtd_por_pagina;

$order = 'ORDER BY idLivro ';

if(isset($_GET['ordem'])){
    switch($_GET['ordem']){
        case 'Az':
            $order = 'ORDER BY titulo';
        break;
    
        case 'Za':
            $order = 'ORDER BY titulo DESC';
        break;
    
        case 'MaisNovos':
            $order = 'ORDER BY idLivro DESC';
        break;
    
        case 'MaisAntigos':
            $order = 'ORDER BY idLivro';
        break;
    
        default:
            $order = 'ORDER BY idLivro';
        break;
    }
}

$pesquisa = isset($_GET['pesquisa']) ? htmlspecialchars($_GET['pesquisa'], ENT_COMPAT, 'UTF-8') : "";

$condicoes = [strlen($pesquisa) ? "titulo LIKE '%".str_replace(' ', '%',$pesquisa)."%'" : null,
             "situacao = 's'"]; 

$condicoes = array_filter($condicoes);

$where = empty($condicoes) ? '': 'WHERE '. implode(' AND ', $condicoes); 

$stmt = $database->query("SELECT idLivro, titulo, capa
                          FROM BK_tbLivro
                          $where $order
                          OFFSET $inicio ROWS
                          FETCH NEXT $qtd_por_pagina ROWS ONLY");

$stmt->execute();

include '../../pages/view/header.php';
include '../../pages/user/galeria-livros.php';
include '../../pages/view/footer.php';