<?php
//incluindo todos os dados do usuario
session_start();
    if(!isset($_SESSION['email']) && !isset($_SESSION['senha'])){
        header('Location: index.php');
    }else{
        $email = $_SESSION['email'];
        $senha = $_SESSION['senha'];
        $foto = $_SESSION['foto'];
        $nome = $_SESSION['nome'];
        $usuario = $_SESSION['id'];
}

//carregando classes no arquivo
require_once '../classes/Banco.php';
$b = new Banco();
require_once '../classes/Comentario.php';
$c = new Comentario($nome, $email, $senha);
    

    //comentario enviado por AJAX
    $comentario = $_POST['comentario'];
    $c->setTexto($comentario);

    //Inserindo comentário do usuario
    $c->comentar($c->getTexto(), $usuario);
    
    //Consulta    
    $r = mysql_query("SELECT * FROM comentario WHERE email = '$email' ORDER BY DataComentario DESC LIMIT 1");
    
    //Exibição
    if(mysql_num_rows($r) == 1){
        
        $row = mysql_fetch_object($r);
        $data = new DateTime($row->dataComentario);
        $dataModel = $data->format('d/m/Y H:m');
        
        echo    '<div id="comentario">'
                . '<p id="coment">' . $row->comentario . '</p>'
                        .'<figure class="perfil">
                            <img src="img/'. $row->foto .'" />
                            <figcaption>
                                <p>' . $row->nome . '</p>
                                <p>' . $dataModel . '</p>
                            </figcaption>
                        </figure>
                </div>';
    }else{
        echo 'error';
    }