<?php

require 'database-connection.php';

//Admin
$nome  = 'admin';
$email = 'admin@admin.com';
$senha = 'admin';
$senha = password_hash($senha, PASSWORD_BCRYPT);

$admin = $database->prepare("INSERT INTO BK_tbUsuario (nome, email, senha, permissao)
                                        VALUES (:nome, :email, :senha, 'a')");
        
$admin->bindParam(':nome',$nome);
$admin->bindParam(':email',$email);
$admin->bindParam(':senha',$senha);


if($admin->execute())
    echo 'admin cadastrado com sucesso <br>';
else
    echo 'Falha ao cadastrar admin<br>';

//Autor
$autor =  $database->exec("INSERT INTO BK_tbAutor (nome,sobre,foto) 
                           VALUES ('Desconhecido','N/D','N/D')");

if($autor)
    echo 'autor desconhecido cadastrado com sucesso';
else
    echo 'Falha ao cadastrar autor';