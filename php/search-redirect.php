<?php

var_dump($_GET);

switch($_GET['galeria']){
    case 'Livros':
        header("location: ./user/galeria-livros.php?pesquisa={$_GET['pesquisa']} ");
    break;

    case 'Autores':
        header("location: ./user/galeria-autores.php?pesquisa={$_GET['pesquisa']} ");
    break;

    default:
    /* esngnag */
}

