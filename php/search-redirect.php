<?php

if($_GET['galeria'] == 'Livros') 
    header("location: ./user/galeria-livros.php?pesquisa={$_GET['pesquisa']} ");

if($_GET['galeria'] == 'Autores') 
    header("location: ./user/galeria-autores.php?pesquisa={$_GET['pesquisa']} ");
