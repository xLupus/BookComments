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

//Busca os autores para o datalist
$stmt = $database->query("SELECT idAutor, nome FROM tbAutor");
$stmt->execute();

while($autores = $stmt->fetch(PDO::FETCH_ASSOC)){
    $idAutor[] = $autores['idAutor'];
    $nomeAutor[] = $autores['nome'];

}
//

if(isset($_POST['btn_cadastrar']) ){
    $titulo       = $_POST['titulo'];
    $autor        = $_POST['autor'];
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
        $titulo =  htmlspecialchars($titulo, ENT_COMPAT, 'UTF-8');     
    }else{$erros["TITULO"] = "Preencha o campo";}

    if(!empty($autor)){
        $autor = htmlspecialchars($autor, ENT_COMPAT, 'UTF-8');    

    }else{$erros["AUTOR"] = "Preencha o campo";}

    if(!empty($autor)){
        $autor = filter_input(INPUT_POST, 'autor', FILTER_SANITIZE_NUMBER_INT);
        if( !filter_var($autor, FILTER_VALIDATE_INT) )
            $erros["AUTOR"] = "Valor invalido no campo";  

    }else{$erros["AUTOR"] = "Preencha o campo";}


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


    if (!empty($sinopse)){
        $sinopse = htmlspecialchars($sinopse, ENT_COMPAT, 'UTF-8');

    }else{$erros["SINOPSE"] = "Preencha o campo";}

    
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

        $tbSinopse = $database->prepare('INSERT INTO tbSinopse (sinopse) VALUES (:sinopse)');
        $tbSinopse->bindParam(':sinopse',  $sinopse);

        if($tbSinopse->execute()){
            $idSinopse = $database->lastInsertId();
        }else{$erros['SINOPSE'] = 'Erro ao adicionar a ';}


        $stmt = $database->prepare('INSERT INTO tbLivro (idSinopse, idAutor, titulo, capa, Lancamento, edicao, volume, numPag, situacao)
                                    VALUES (:idSinopse, :autor, :titulo, :capa, :lancamento, :edicao, :volume, :paginas, :situacao)');


        $stmt->bindParam(':idSinopse',  $idSinopse );
        $stmt->bindParam(':autor',      $autor );
        $stmt->bindParam(':titulo',     $titulo );
        $stmt->bindParam(':capa',       $arquivoEnviado);
        $stmt->bindParam(':lancamento', $lancamento );
        $stmt->bindParam(':edicao',     $edicao );
        $stmt->bindParam(':volume',     $volume);
        $stmt->bindParam(':paginas',    $paginas);
        $stmt->bindParam(':situacao',   $situacao);

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