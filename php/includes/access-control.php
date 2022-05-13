<?php

session_start();

if( !isset($_SESSION['id']) || !isset($_SESSION['permissao'])){
    header('location: php/validar-login.php');
    exit();
}