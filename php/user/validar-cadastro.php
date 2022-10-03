<?php

include '../includes/applica-control.php';
require_once '../includes/database-connection.php';

$nome  = '' ;
$email = '';
$senha = '';

if(isset($_POST['btn_cadastrar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = trim($_POST['senha'], '');
    $erros = [];

    if(!empty($nome)){
        $nome = htmlspecialchars($nome, ENT_COMPAT, 'UTF-8');    
    }else{$erros["NOME"] = "Preencha o campo";}


    if(!empty($email)){
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    }else{$erros["EMAIL"] = "Preencha o campo";}


    if(empty($senha))
        $erros["SENHA"] = "Preencha o campo";

    if(empty($erros)){
        $senha = password_hash($senha, PASSWORD_BCRYPT);

        $checagem = $database->prepare('SELECT email FROM BK_tbUsuario WHERE email = :email');
        $checagem->bindParam(':email', $email);
        $checagem->execute();
        $c = $checagem->fetch(PDO::FETCH_ASSOC);
        
        if($c == false){ //Se o email n existir no BD     
            $stmt = $database->prepare("INSERT INTO BK_tbUsuario (nome, email, senha, permissao)
                                        VALUES (:nome, :email, :senha, 'u')");
        
            $stmt->bindParam(':nome',$nome);
            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':senha',$senha);
        
            if($stmt->execute()){
                $idUser = $database->lastInsertId();
                               
                $_SESSION['id'] = $idUser;
                $_SESSION['permissao'] = 'u';
                
                header('location: ../../index.php');
            }
        }else{
            $erros["EMAIL"] = "Valor do campo ja cadastrado";
        }
    }
}

include '../../pages/user/cadastrar.php';
