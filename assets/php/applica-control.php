<?php

session_start();

if( isset($_SESSION['id']) || isset($_SESSION['tipo'])){
    header('location: ../index.php');
    exit();
}