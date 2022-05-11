<?php

require_once 'includes/database-connection.php';

$warning = '';

$nome = trim( $_POST['nome'] ?? '' );
$email = trim( $_POST['email'] ?? '' );
$senha = trim( $_POST['senha'] ?? '' );

if( !empty($nome) && !empty($email) && !empty($senha)){ //inputs vazios

    $senha = password_hash($senha, PASSWORD_BCRYPT);

    $checagem = $database->prepare('SELECT email FROM Usuario WHERE email = :email');
    $checagem->bindParam(':email', $email);
    $checagem->execute();
    $c = $checagem->fetch(PDO::FETCH_ASSOC);
    
    if($c == false){ //Se o email n existir no BD
        
        $stmt = $database->prepare("INSERT INTO Usuario (nomeUser,email,senha,permissao)
                                    VALUES (:nome, :email, :senha, 'u')");
    
        $stmt->bindParam(':nome',$nome);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':senha',$senha);
    
        if($stmt->execute()){

            $query = $database->prepare('SELECT idUsuario FROM Usuario WHERE email = :email');
            $query->bindParam(':email',$email);
            $query->execute();

            if( $idUser = $query->fetch(PDO::FETCH_ASSOC) ){
                
                session_start();
                $_SESSION['id'] = $idUser['idUsuario'];
                $_SESSION['permissao'] = 'u';
                
                header('location: ../index.php');
            }
        }
    }else{$warning++;}
}else{$warning++;}

if($warning > 0){
    $warningText = "<p style='color:red;text-align:center'> *E-mail ou senha incorretos </p>";
    $warningBox = "style='border:2px solid red'";
    $warningColorText = "style='color:red'";
    $redirectLink = '../pages/login.php';
}

include '../pages/cadastrar.php';