<?php

require_once 'database-connection.php';

$nome = trim( $_POST['nome'] ?? '' );
$email = trim( $_POST['email'] ?? '' );
$senha = trim( $_POST['senha'] ?? '' );

if( empty($nome) || empty($email) || empty($senha)){ //inputs vazios
    header('location: ../../pages/cadastrar.php');
    exit();

}else{
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
                $_SESSION['id'] = $idUser;
                $_SESSION['permissao'] = 'u';
                
                header('location: ../../index.php');
            }            
        }
    }else{ 
        echo 'email ja cadastrado';
    }
}
