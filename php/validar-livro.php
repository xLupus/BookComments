<?php

require_once 'includes/database-connection.php';

//insert da sinopse é feito em outra tabela 

$titulo = '';
$autor = '';
$lancamento = '';
$edicao = '';
$volume = '';
$paginas = '';
$sinopse = '';
$situacao = '';

if(isset($_POST['btn_cadastrar']) ){
    $titulo       = $_POST['titulo'];
    //$autor        = $_POST['autor'];
    $lancamento   = $_POST['lancamento'];
    $edicao       = $_POST['edicao'];
    $volume       = $_POST['volume'];
    $paginas      = $_POST['paginas'];
    $sinopse      = $_POST['sinopse'];
    $situacao     = $_POST['situacao'];

    //ARRAY DE ERROS
    $erros = [];

    //LIMPEZA E VALIDAÇÃO
    if(!empty($titulo)){
        $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRIPPED);     
    }else{$erros["TITULO"] = "Preencha o campo";}


    if(!empty($lancamento)){
        $lancamento = filter_input(INPUT_POST, 'lancamento', FILTER_SANITIZE_NUMBER_INT);
        if( !filter_var($lancamento, FILTER_VALIDATE_INT) )
            $erros["LANCAMENTO"] = "Valor invalido no campo";  

    }else{$erros["LANCAMENTO"] = "Preencha o campo";}


    if(!empty($edicao)){
        $edicao = filter_input(INPUT_POST, 'edicao', FILTER_SANITIZE_NUMBER_INT);
        if( !filter_var($edicao,FILTER_VALIDATE_INT ) )
            $erros["EDICAO"] =  "Valor invalido no campo"; 

    }else{$erros["EDICAO"] =  "Preencha o campo";}


    if(!empty($volume)){
        $volume = filter_input(INPUT_POST, 'volume', FILTER_SANITIZE_NUMBER_INT);
        if( !filter_var($volume,FILTER_VALIDATE_INT ) )
            $erros["VOLUME"] = "Valor invalido no campo";  

    }else{$erros["VOLUME"] =  "Preencha o campo";}


    if(!empty($paginas)){
        $paginas = filter_input(INPUT_POST, 'paginas', FILTER_SANITIZE_NUMBER_INT);
        if( !filter_var($paginas, FILTER_VALIDATE_INT) )
            $erros["PAGINAS"] = "Valor invalido no campo";  

    }else{$erros["PAGINAS"] = "Preencha o campo";}


    if (!empty($sinopse)) 
        $sinopse = filter_input(INPUT_POST, 'sinopse', FILTER_SANITIZE_STRIPPED);

    else{$erros["SINOPSE"] = "Preencha o campo";}

    
    if(empty($situacao)){
        $erros['SITUACAO'] = "Preencha o campo";
    }


    if( $_FILES['imagem']['error'] == 0  && $_FILES['imagem']['size'] > 0){ //inserir imagem

        $mimeType = mime_content_type($_FILES['imagem']['tmp_name']);
        $campos = explode('/', $mimeType);
        $tipo = $campos[0];
        $ext = $campos[1];
    
        if(empty($erros)){
            if( $tipo == 'image'){
                $arquivoEnviado = '../assets/images/capa-livro/'.$_FILES['imagem']['name']; //.'.'.$ext
        
                move_uploaded_file($_FILES['imagem']['tmp_name'], "$arquivoEnviado");
        
            }else { $erros["IMAGEM"]  = 'So é permitido o upload de';} 
        }
    
    }else{$erros['IMAGEM'] = 'Preencha o campo';}



    if(empty($erros)){
        //try e catch?
        $stmt = $database->prepare('INSERT INTO Livro (titulo,  capa,   anoLanc,     edicao,  volume,  numPag,   sinopse,  situacao)
                                    VALUES (:titulo, :capa, :lancamento, :edicao, :volume, :paginas, :sinopse, :situacao)');

        $stmt->bindParam(':titulo',     $titulo );
        $stmt->bindParam(':capa',       $arquivoEnviado);
        $stmt->bindParam(':lancamento', $lancamento );
        $stmt->bindParam(':edicao',     $edicao );
        $stmt->bindParam(':volume',     $volume);
        $stmt->bindParam(':paginas',    $paginas);
        $stmt->bindParam(':sinopse',    $sinopse);
        $stmt->bindParam(':situacao',   $situacao);
        //Autor posteriormente

        if($stmt->execute()){
            $confirmation =  "<div class='validation-ok'>
                                <p>Livro cadastrado com sucesso</p>
                              </div>";
        }else{
            $confirmation =  "<div class='validation-ok'>
                                <p>Erro ao cadastrado o livro</p>
                              </div>";
        }
    }
   
}

include '../pages/cadastrar-livro.php';