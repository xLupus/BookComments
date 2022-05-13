<?php

require_once 'includes/database-connection.php';

$nomeAutor = '';
$sobreAutor = '';
$lancamento = '';
$edicao = '';


if(isset($_POST['btn_cadastrar'])){
    $nomeAutor = $_POST['nome'];
    $sobreAutor = $_POST['sobre'];
    $arquivoEnviado = '';
    $erros = [];

    if(!empty($nomeAutor)){
        $nomeAutor = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRIPPED); 
    }else{$erros["AUTOR"] = "Preencha o campo";}


    if(!empty($sobreAutor)){
        $sobreAutor = filter_input(INPUT_POST, 'sobre', FILTER_SANITIZE_STRIPPED); 
    }else{ $erros["SOBRE"] = "Preencha o campo";}
    

    if($_FILES['imagem']['error'] == 0  && $_FILES['imagem']['size'] > 0){ //inserir imagem

            $mimeType = mime_content_type($_FILES['imagem']['tmp_name']);
            $campos = explode('/', $mimeType);
            $tipo = $campos[0];
            $ext = $campos[1];
        
            if( $tipo == 'image'){
                $arquivoEnviado = '../assets/images/foto-autor/'.$_FILES['imagem']['name']; //.'.'.$ext
                move_uploaded_file($_FILES['imagem']['tmp_name'], "$arquivoEnviado");

            }else $erros["IMAGEM"]  = 'So é permitido o upload de';
        
    }else $erros["IMAGEM"] = "Preencha o campo";

               
    if(empty($erros)){
        //try e catch?
        $stmt = $database->prepare('INSERT INTO Autor (nomeAutor, sobreAutor, foto)
                                    VALUES (:nome, :sobre, :diretorioFoto)');

        $stmt->bindParam(':nome', $nomeAutor);
        $stmt->bindParam(':sobre', $sobreAutor);
        $stmt->bindParam(':diretorioFoto', $arquivoEnviado);

        if($stmt->execute()){
            $confirmation =  "<div class='validation-ok'>
                                <p>Autor inserido com sucesso</p>
                              </div>";
        }else{
            $confirmation =  "<div class='validation-ok'>
                                <p>Erro ao inserir o autor</p>
                              </div>";
        }
    }
}

include '../pages/cadastrar-autor.php';
