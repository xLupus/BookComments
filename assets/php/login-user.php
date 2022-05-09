<?php

require_once 'database-connection.php';

$email = trim( $_POST['email'] ?? '' );
$senha = trim( $_POST['senha'] ?? '' );

if( empty($email) || empty($senha) ){ //inputs vazios
    header('location: ../../pages/login.php');
    exit();

}else{
    $stmt = $database->prepare('SELECT email, senha FROM Usuario WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    $c = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($c != false){ //Se o email estiver cadastrado no bd
    
        if( password_verify($senha , $c['senha']) ){
            session_start();
            $_SESSION['id'] = $email;
            $_SESSION['tipo'] = 0;
    
            header('location: ../../index.php');

        }else{
            echo 'email ou senha incorretos(senha)';
        }
    
    }else{
        echo 'email ou senha incorretos(email)';
    }
}


