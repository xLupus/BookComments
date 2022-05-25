<?php

require_once '../includes/database-connection.php';

$titulo = '';
$autor = '';
$lancamento = '';
$edicao = '';
$volume = '';
$paginas = '';
$sinopse = '';
$situacao = '';

//Busca os autores para o datalist
$stmt = $database->query("SELECT idAutor, nome FROM BK_tbAutor");
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
        $autor = preg_replace('/\D/', '', $autor);

        if(empty($autor)){
            $erros["AUTOR"] = "Insira um valor valido no campo"; 
        }else{
            $inBD = $database->query("SELECT idAutor FROM BK_tbAutor WHERE idAutor = $autor");
            $inBD->execute();
    
            if(!$idFromBD = $inBD->fetch(PDO::FETCH_ASSOC)){
                $erros["AUTOR"] = "Valor invalido no campo" ;
            }
        }

    }else{$erros["AUTOR"] = "Preencha o campo";}


    if(!empty($lancamento)){
        $lancamento = preg_replace('/\D/', '', $lancamento);
        if(empty($lancamento))
            $erros["LANCAMENTO"] = "Insira um valor valido no campo";  

    }else{$erros["LANCAMENTO"] = "Preencha o campo";}


    if(!empty($edicao)){
        $edicao = preg_replace('/\D/', '', $edicao);
        if(empty($edicao))
            $erros["EDICAO"] = "Insira um valor valido no campo";  

    }else{$erros["EDICAO"] = "Preencha o campo";}


    if(!empty($volume)){
        $volume = preg_replace('/\D/', '', $volume);
        if(empty($volume))
            $erros["VOLUME"] = "Insira um valor valido no campo";  

    }else{$erros["VOLUME"] = "Preencha o campo";}


    if(!empty($paginas)){
        $paginas = preg_replace('/\D/', '', $paginas);
        if(empty($paginas))
            $erros["PAGINAS"] = "Insira um valor valido no campo";  

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
                $arquivoEnviado = '../../assets/images/capa-livro/'.$_FILES['imagem']['name']; //.'.'.$ext
                move_uploaded_file($_FILES['imagem']['tmp_name'], "$arquivoEnviado");
        
            }else { $erros["IMAGEM"]  = 'So é permitido o upload de';} 
        }
    
    }else{$erros['IMAGEM'] = 'Preencha o campo';}



    if(empty($erros)){

        $tbSinopse = $database->prepare('INSERT INTO BK_tbSinopse (sinopse) VALUES (:sinopse)');
        $tbSinopse->bindParam(':sinopse', $sinopse);

        if($tbSinopse->execute()){
            $idSinopse = $database->lastInsertId();
        }else{$erros['SINOPSE'] = 'Erro ao adicionar a ';}

        $stmt = $database->prepare('INSERT INTO BK_tbLivro (idSinopse, idAutor, titulo, capa, Lancamento, edicao, volume, numPag, situacao)
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

include '../../pages/view/header.php';
include '../../pages/admin/cadastrar-livro.php';
include '../../pages/view/footer.php';