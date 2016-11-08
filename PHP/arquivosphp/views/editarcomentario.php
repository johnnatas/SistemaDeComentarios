<h1> Comentario a ser editado </h1>
<?php

require_once '../../classes/Banco.php';
$b = new Banco();
session_start();
$usuario = $_SESSION['id'];
$idcoments = $_POST['id'];

    $r = mysql_query("SELECT c.dscomentario, u.foto, u.nome, c.dtcomentario, c.idcoments, c.status_edicao
                    FROM coments as c inner join users as u
                    WHERE c.idcoments = '$idcoments' AND u.idusers = '$usuario'");


    if(mysql_num_rows($r) == 1){
    $row = mysql_fetch_object($r);
//formata a data do comentario;
            $data = new DateTime($row->dtcomentario);
            $dataComent = $data->format('d/m/Y H:m');

            //se o comentário estiver editado
            if($row->status_edicao == true){
                //adicionando a identificação do comentario para realizar pesquisa
                $idcomentario = $row->idcoments;

                //seleciona a tabela de edições
                $linha = mysql_query("SELECT * FROM editions WHERE idcoments = '$idcomentario' AND status_edition = false");

                if(mysql_num_rows($linha) == 1){
                    $l =  mysql_fetch_object($linha);

                    //formata a data da edição do comentario
                    $data = new DateTime($l->dtedition);
                    $dataEdit = $data->format('d/m/Y H:m');

                    echo    '<div class="comentario" id="'. $row->idcoments .'" rel="'. $l->idedition .'">
                                <p class="coment">' . $l->dsedition . '</p>
                                <div class="descricao">
                                    <p><small>Publicado: ' . $dataComent . '</small></p>
                                    <p><small>Editado: ' . $dataEdit . '</small></p>
                                </div>
                        </div>';
                }
            }
            //se o o comentário não estiver editado
            else{
            echo    '<div class="comentario" id="'. $row->idcoments .'" rel="null">
                        <p class="coment">' . $row->dscomentario . '</p>
                        <div class="descricao">
                            <p>' . $dataComent . '</p>
                        </div>
                </div>';
        }                
    }
?>

    <textarea id="comentario" name="comentario" placeholder="Escreva seu comentário..."></textarea>
    <p id="notcoment">Comentário vazio não pode ser enviado</p>
    <input id="atualizar" type="submit" value="Enviar" />
    <input id="cancelar" type="submit" value="Cancelar" />

<h1> Histórico de edições </h1>
<?php
    //seleciona o histórico do comentário
    $line = mysql_query("SELECT dtedition, dsedition FROM editions WHERE idcoments = '$idcoments' ORDER BY dtedition DESC");

    if(mysql_num_rows($line) > 0){
        while($row = mysql_fetch_object($line)){

            $data = new DateTime($row->dtedition);
            $dataEdition = $data->format('d/m/Y H:m:s');

            echo '<div class="comentario">
                    <p class="coment">' . $row->dsedition . '</p>
                    <div class="descricao">
                        <p>' . $dataEdition . '</p>
                    </div>
            </div>';
        }

        $newRow = mysql_query("SELECT dtcomentario, dscomentario FROM coments WHERE idcoments = '$idcoments'");
        if(mysql_num_rows($newRow) == 1){
            $nr = mysql_fetch_object($newRow);
            $data = new DateTime($nr->dtcomentario);
            $dataComentario = $data->format('d/m/Y H:m:s');

                echo '<div class="comentario">
                        <p class="coment">' . $nr->dscomentario . '</p>
                        <div class="descricao">
                            <p>' . $dataComentario . '</p>
                        </div>
                </div>';
        }
    }

    else{
        echo '<h3>Não há edições</h3>';
    }
?>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/script.js"></script>