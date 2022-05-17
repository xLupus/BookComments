<?php

function getLivros ($where = null, $order = null,  $limit = null){

    require '../includes/database-connection.php';

    $stmt = $database->query("SELECT idLivro, BK_tbAutor.nome, titulo, 
                              CASE WHEN situacao = 's' THEN 'Ativo' 
                              WHEN situacao = 'n' THEN 'Inativo'
                              END AS situacao
                              FROM BK_tbLivro
                              INNER JOIN BK_tbAutor 
                              ON BK_tbAutor.idAutor = BK_tbLivro.idAutor
                              $where $order");
 
    $stmt->execute();

    echo "<form method='GET'>
        <table border='1' class='table'>
            <thead>
                <tr>
                    <th>ID</th> <th>Titulo</th> <th>Autor</th> <th>Status</th> <th>Ações</th>
                </tr>
            </thead>
            <tbody>
    ";

    while($livros = $stmt->fetch(PDO::FETCH_ASSOC)){

        echo "<tr>
                <th>{$livros['idLivro']}</th>

                <td>{$livros['titulo']}</td>

                <td>{$livros['nome']}</td>

                <td>{$livros['situacao']}</td>

                <td><button type='submit' formaction='../admin/atualizar-livro.php' name='id' value='{$livros['idLivro']}'>Editar</button></td>
            </tr>
        ";
    }

    echo "      </tbody>
            </table>
        </form>
    ";

}

function GetAutor($where = null, $order = null,  $limit = null){

    require '../includes/database-connection.php';

    $stmt = $database->query("SELECT idAutor, nome 
                             FROM BK_tbAutor
                             $where $order");
 
    $stmt->execute();

    echo "<form method='GET'>
        <table border='1' class='table'>
            <tr>
                <td>ID</td> <td>Autor</td> <td>Ações</td>
            </tr>
    ";

    while($autores = $stmt->fetch(PDO::FETCH_ASSOC)){

        echo "<tr>
                <td>{$autores['idAutor']}</td>

                <td>{$autores['nome']}</td>


                <td><button type='submit' formaction='../admin/atualizar-autor.php' name='id' value='{$autores['idAutor']}'>Editar</button></td>
            </tr>
        ";
    }

    echo "</table>
        </form>
    ";

}