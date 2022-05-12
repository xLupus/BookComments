<?php

require_once 'includes/database-connection.php';
include '../php/includes/applica-control.php';

$boxError = 'class="box-error"';
$email = '';
$senha = '';

if(isset($_POST['btn_entrar'])){
    $email = $_POST['email'];
    $senha = trim($_POST['senha'], '');
    $erros = [];


    if(!empty($email)){
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); 
    }else{$erros["EMAIL"] = "Preencha o campo";}


    if(empty($senha)){
        $erros["SENHA"] = "Preencha o campo";
    }
    /*
    if(!empty($senha)){
        $senha = filter_input(INPUT_POST, 'sobre', FILTER_SANITIZE_STRIPPED); 
    }else{ $erros["SENHA"] = "Preencha o campo";}
    */
    
    if(empty($erros)){

        $stmt = $database->prepare('SELECT idUsuario, email, senha, permissao FROM Usuario WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $c = $stmt->fetch(PDO::FETCH_ASSOC);

        if($c != false){ //Se o email estiver cadastrado no bd
            if( password_verify($senha , $c['senha']) ){
                session_start();
                $_SESSION['id'] = $c['idUsuario'];
                $_SESSION['permissao'] = $c['permissao'];
        
                header('location: ../index.php');
    
            }else{$erros['incorretos'] = 'Email ou senha';}
        }else{$erros['incorretos'] = 'Email ou senha';}
    }
}

include '../pages/login.php';