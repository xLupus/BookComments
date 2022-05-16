<?php

include './includes/database-connection.php';

var_dump($_GET);

if(isset($_GET['autor']) && $_GET['autor'] != ""){

    $idAutor = preg_replace('/\D/', '',$_GET['autor']);

    if(!empty($idAutor)){
        $stmt = $database->prepare("SELECT nome, sobre, foto FROM BK_tbAutor WHERE idAutor = :id");
        $stmt->bindParam(':id', $idAutor);
        $stmt->execute();
    
        if($autorContent = $stmt->fetch(PDO::FETCH_ASSOC)){
            $nome = $autorContent['nome'];
            $sobre = $autorContent['sobre'];
            $foto = $autorContent['foto'];
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
            </script>
        ";
    }

}else{
    echo "
    <script>
        alert('preencha o campo id')
        window.history.go(-1)
    </script>
";
}

if(isset($_POST['btn_atualizar'])){
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
        
            if( $tipo == 'image'){
                $arquivoEnviado = '../assets/images/foto-autor/'.$_FILES['imagem']['name']; //.'.'.$ext
                move_uploaded_file($_FILES['imagem']['tmp_name'], "$arquivoEnviado");

            }else $erros["IMAGEM"]  = 'So é permitido o upload de';
        
    }else{
        $arquivoEnviado = $autorContent['foto'];
    }


    if(empty($erros)){
        //try e catch?
        $stmt = $database->prepare("UPDATE BK_tbAutor SET nome = :nome, sobre = :sobre, foto = :diretorioFoto
                                    WHERE idAutor = :id");

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':sobre', $sobre);
        $stmt->bindParam(':diretorioFoto', $arquivoEnviado);
        $stmt->bindParam(':id', $idAutor);

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




include '../pages/update-autor.php';

