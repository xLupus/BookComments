<?php

include_once '../includes/database-connection.php';

//Pagina 'atual'
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

//SELECTIONA TOTOS OS RESULTADOS
$resultados = $database->query("SELECT qtd = count(*) FROM BK_tbAutor WHERE idAutor != 1");
$resultados->execute();

$total_de_resultados = $resultados->fetch(PDO::FETCH_ASSOC);

//QUNATIDADE POR PAGINA
$qtd_por_pagina = 6;

//quantidade de paginas necessarias
$num_paginas = ceil($total_de_resultados['qtd'] / $qtd_por_pagina);

//Inicio da visualização
$inicio = $qtd_por_pagina * $pagina - $qtd_por_pagina;

$order = 'ORDER BY idAutor ';

if(isset($_GET['ordem'])){
    switch($_GET['ordem']){
        case 'Az':
            $order = 'ORDER BY nome ';
        break;
    
        case 'Za':
            $order = 'ORDER BY nome DESC ';
        break;
    
        case 'MaisNovos':
            $order = 'ORDER BY idAutor DESC ';
        break;
    
        case 'MaisAntigos':
            $order = 'ORDER BY idAutor ';
        break;
    
        default:
            $order = 'ORDER BY idAutor ';
        break;
    }
}


$pesquisa = isset($_GET['pesquisa']) ? htmlspecialchars($_GET['pesquisa'], ENT_COMPAT, 'UTF-8') : "";

$condicoes = [strlen($pesquisa) ? "nome LIKE '%".str_replace(' ', '%',$pesquisa)."%'" : null,
             'idAutor != 1']; 

$condicoes = array_filter($condicoes);

$where = empty($condicoes) ? '': 'WHERE '. implode(' AND ', $condicoes); 

$stmt = $database->query("SELECT idAutor, nome, foto
                          FROM BK_tbAutor
                          $where $order
                          OFFSET $inicio ROWS
                          FETCH NEXT $qtd_por_pagina ROWS ONLY");

$stmt->execute();

include '../../pages/view/header.php';
include '../../pages/user/galeria-autores.php';
include '../../pages/view/footer.php';