<?php

include_once '../includes/database-connection.php';

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

//Pagina 'atual'
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$pagina_anterior = $pagina - 1;
$pagina_posterior = $pagina + 1;

//SELECTIONA TOTOS OS RESULTADOS
$resultados = $database->query("SELECT qtd = count(*)
                                FROM BK_tbAutor
                                $where");
$resultados->execute();

$total_de_resultados = $resultados->fetch(PDO::FETCH_ASSOC);

//QUNATIDADE POR PAGINA
$qtd_por_pagina = 10;

//quantidade de paginas necessarias
$num_paginas = ceil($total_de_resultados['qtd'] / $qtd_por_pagina);

//Inicio da visualização
$inicio = $qtd_por_pagina * $pagina - $qtd_por_pagina;


$stmt = $database->query("SELECT idAutor, nome, foto
                          FROM BK_tbAutor
                          $where $order
                          OFFSET $inicio ROWS
                          FETCH NEXT $qtd_por_pagina ROWS ONLY");

$stmt->execute();
$t = $stmt->rowCount();



include '../../pages/view/header.php';
include '../../pages/user/galeria-autores.php';
include '../../pages/view/footer.php';

?>
<script src="../../js/footer.js"></script>
