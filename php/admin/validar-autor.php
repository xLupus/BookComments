<?php

require_once '../includes/database-connection.php';

$nome = '';
$sobre = '';
$foto = '';

if(isset($_POST['btn_cadastrar'])){
    $nome = $_POST['nome'];
    $sobre = $_POST['sobre'];
    $arquivoEnviado = '';
    $erros = [];

    if(!empty($nome)){
        $nome = htmlspecialchars($nome, ENT_COMPAT, 'UTF-8');
    }else{$erros["AUTOR"] = "Preencha o campo";}


    if(!empty($sobre)){
        $sobre = htmlspecialchars($sobre, ENT_COMPAT, 'UTF-8');
    }else{ $erros["SOBRE"] = "Preencha o campo";}

    
    if($_FILES['imagem']['error'] == 0  && $_FILES['imagem']['size'] > 0){ //inserir imagem
        //extension=fileinfo
        $mimeType = mime_content_type($_FILES['imagem']['tmp_name']);
        $campos = explode('/', $mimeType);
        $tipo = $campos[0];
        $ext = $campos[1];
    
        if(empty($erros)){

            if( $tipo == 'image'){
                $arquivoEnviado = '../../assets/images/foto-autor/'.$_FILES['imagem']['name']; //.'.'.$ext
                move_uploaded_file($_FILES['imagem']['tmp_name'], "$arquivoEnviado");
    
            }else {$erros["IMAGEM"]  = 'So é permitido o upload de';}
        }

    }else{$erros["IMAGEM"] = "Preencha o campo";}

               
    if(empty($erros)){
        
        $stmt = $database->prepare('INSERT INTO BK_tbAutor (nome, sobre, foto)
                                    VALUES (:nome, :sobre, :diretorioFoto)');

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':sobre', $sobre);
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
include '../../pages/view/header.php';
include '../../pages/admin/cadastrar-autor.php';
include '../../pages/view/footer.php';
