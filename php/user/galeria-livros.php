<?php

include_once '../includes/database-connection.php';

$order = '';

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
            $order = null;
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
                          $where $order");

$stmt->execute();

include '../../pages/view/header.php';
include '../../pages/user/galeria-livros.php';
include '../../pages/view/footer.php';