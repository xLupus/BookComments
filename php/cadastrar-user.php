<?php

include '../php/includes/applica-control.php';
require_once 'includes/database-connection.php';

$nome  = '' ;
$email = '';
$senha = '';

if(isset($_POST['btn_cadastrar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = trim($_POST['senha'], '');
    $erros = [];


    if(!empty($nome)){
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRIPPED);     
    }else{$erros["NOME"] = "Preencha o campo";}


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
        }else{$erros["EMAIL"] = "Valor do campo ja cadastrado";}
    }
}

include '../pages/cadastrar.php';