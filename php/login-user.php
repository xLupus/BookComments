<?php

require_once 'includes/database-connection.php';

$warning = '';

$email = trim( $_POST['email'] ?? '' );
$senha = trim( $_POST['senha'] ?? '' );

if( !empty($email) && !empty($senha) ){ //inputs preenchidos

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

        }else{$warning++;}
    }else{$warning++;}
}else{$warning++;}

if($warning >= 1){
    $warningText = "<p style='color:red;text-align:center'> *E-mail ou senha incorretos </p>";
    $warningBox = "style='border:2px solid red'";
    $warningColorText = "style='color:red'";
    $redirectLink = '../pages/cadastrar.php';
}
include '../pages/login.php';
