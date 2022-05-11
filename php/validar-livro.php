<?php

require_once 'includes/database-connection.php';
echo '<pre>';
var_dump($_FILES);
var_dump($_POST);
echo '</pre>';

$titulo       = $_POST['titulo'];
$autor        = $_POST['autor'];
$lancamento   = $_POST['lancamento'];
$edicao       = $_POST['edicao'];
$volume       = $_POST['volume'];
$paginas      = $_POST['paginas'];
$sinopse      = $_POST['sinopse'];
$situacao     = $_POST['situacao'];

$vazio = 0;

if($vazio > 1){
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
    
    $stmt = $database->prepare('INSERT INTO Livro (titulo,  capa,   anoLanc,     edicao,  volume,  numPag,   sinopse,  situacao)
                                VALUES            (:titulo, :capa, :lancamento, :edicao, :volume, :paginas, :sinopse, :situacao)');
    
    $stmt->bindParam(':titulo',     $titulo );
    $stmt->bindParam(':capa',       $arquivoEnviado);
    $stmt->bindParam(':lancamento', $lancamento );
    $stmt->bindParam(':edicao',     $edicao );
    $stmt->bindParam(':volume',     $volume);
    $stmt->bindParam(':paginas',    $paginas);
    $stmt->bindParam(':sinopse',    $sinopse);
    $stmt->bindParam(':situacao',   $sinopse);
    
    if($stmt->execute()){
        echo 'realizado com sucesso';
    }
}