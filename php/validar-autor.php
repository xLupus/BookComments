<?php

require_once 'includes/database-connection.php';

$nomeAutor = $_POST['nome'];
$sobreAutor = $_POST['sobre'];

$arquivoEnviado = '';

if(!empty($_FILES) && !empty($_POST['nome']) && !empty($_POST['sobre']) ){
    
    if( $_FILES['imagem']['error'] == 0  && $_FILES['imagem']['size'] > 0){ //inserir imagem

        $mimeType = mime_content_type($_FILES['imagem']['tmp_name']);
        $campos = explode('/', $mimeType);
        $tipo = $campos[0];
        $ext = $campos[1];
    
        if( $tipo == 'image'){
            $arquivoEnviado = '../assets/images/foto-autor/'.$_FILES['imagem']['name']; //.'.'.$ext
    
            move_uploaded_file($_FILES['imagem']['tmp_name'], "$arquivoEnviado");

        }else{
            echo 'Usuario, So pode enviar imagens';
        }
    }

    $stmt = $database->prepare('INSERT INTO Autor (nomeAutor, sobreAutor, foto)
                                VALUES (:nome, :sobre, :diretorioFoto)');

    $stmt->bindParam(':nome', $nomeAutor);
    $stmt->bindParam(':sobre', $sobreAutor);
    $stmt->bindParam(':diretorioFoto', $arquivoEnviado);

    if($stmt->execute()){
        echo 'realizado com sucesso';
    }
    
    echo 'tudo certo';

}else{
    echo 'algo n foi preenchido';
}

include '../pages/cadastrar-autor.php';
