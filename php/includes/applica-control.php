<?php

session_start();

if( isset($_SESSION['id']) || isset($_SESSION['permissao'])){
    header('location: ../../index.php');
    exit();
}