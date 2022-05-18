<?php

include '../includes/database-connection.php';

//Busca os autores para o datalist
$stmt = $database->query("SELECT idAutor, nome FROM BK_tbAutor");
$stmt->execute();

while($autores = $stmt->fetch(PDO::FETCH_ASSOC)){
    $idAutor[] = $autores['idAutor'];
    $nomeAutor[] = $autores['nome'];

}
//

if(isset($_GET['id'])){ /* pegar as informaçoes e exibir */

    $idLivro = preg_replace('/\D/', '',$_GET['id']);

    if(!empty($idLivro)){
        $stmt = $database->prepare("SELECT idAutor, BK_tbSinopse.sinopse, titulo, capa, lancamento, edicao, volume, numPag, situacao 
                                    FROM BK_tbLivro 
                                    INNER JOIN BK_tbSinopse on BK_tbSinopse.idSinopse = BK_tbLivro.idSinopse
                                    WHERE idLivro = :id");

        $stmt->bindParam(':id', $idLivro);
        $stmt->execute();
        
        if($livroContent = $stmt->fetch(PDO::FETCH_ASSOC)){
            $titulo = $livroContent['titulo'];
            $capa = $livroContent['capa'];
            $autor = $livroContent['idAutor'];
            $lancamento = $livroContent['lancamento'];
            $edicao = $livroContent['edicao'];
            $volume = $livroContent['volume'];
            $paginas = $livroContent['numPag'];
            $sinopse = $livroContent['sinopse'];
            $situacao = $livroContent['situacao'];
            

        }else{
            echo "
                <script>
                    alert('Autor invalido')
                    window.history.go(-1)
                </script>
            ";
            
        }
    }else{
        echo "
            <script>
                alert('ID invalido')
                window.history.go(-1)
                exit()
            </script>
        ";
    }
}


//ATUALIZAÇÃO DOS DADOS
if(isset($_POST['btn_atualizar'])){ 

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
    //

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
    
    }else{
        $arquivoEnviado = $livroContent['capa'];
    }

    if(empty($erros)){

        $stmt = $database->prepare('UPDATE BK_tbSinopse SET sinopse = :sinopse
                                    WHERE idSinopse = :idSinopse');

        $stmt->bindParam(':sinopse',    $sinopse);
        $stmt->bindParam(':idSinopse',  $idLivro);
        $stmt->execute();


        $stmt = $database->prepare("UPDATE BK_tbLivro SET titulo = :titulo, idAutor = :autor, Lancamento = :lancamento, edicao = :edicao, 
                                            volume = :volume, numPag = :paginas, situacao = :situacao, capa = :capa, idSinopse = :idSinopse
                                    WHERE idLivro = {$_GET['id']} ");
        
        
        $stmt->bindParam(':idSinopse',  $idLivro);
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
                                <p>Livro Atualizado com sucesso</p>
                              </div>";
        }else{
            $confirmation =  "<div class='validation-ok'>
                                <p>Erro ao Atualizar o livro</p>
                              </div>";
        }
    }
}

include '../../pages/admin/update-livro.php';