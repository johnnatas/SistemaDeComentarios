<!DOCTYPE html>
<?php
    //inicia uma sessão e os dados do usuário
    include 'arquivosphp/sessao.php';

    //carregando as classses necessárias
    require_once 'classes/Banco.php';
    $b = new Banco();
    require_once 'classes/Sistema.php';
    $s = new Sistema();
    
    include 'arquivosphp/upload.php';
    include 'arquivosphp/modificarDados.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/perfil.css"/>
    </head>
    <body>
        <header>
            <?php
                $s->cabecalhoLogado();
            ?>
        </header>
    <aside id="user">
        <div id="dados">
            <figure class="img">
                <img src="<?php echo 'img/'.$foto; ?>"/>
                <figcaption>
                    <label id="editar">Editar foto de Perfil</label><br/>
                </figcaption>
            </figure>
            <h1><a href="perfil.php"><?php echo $nome; ?></a></h1>
            <p><?php echo $email; ?></p>
            <a href="" class="op">Alterar dados</a>
        </div>
    </aside>
    
    <section id="exibicao">
        
        <h1> Todos os seus comentários </h1>
            <?php 
                $r = mysql_query("SELECT c.dscomentario, u.foto, u.nome, c.dtcomentario, c.idcoments, c.status_edicao
                                FROM coments as c inner join users as u 
                                WHERE c.idusers = '$usuario' AND u.idusers = '$usuario'
                                ORDER BY c.dtcomentario DESC");

                if(mysql_num_rows($r) > 0){
                        while ($row = mysql_fetch_object($r)){
                            
                            //formata a data do comentario;
                            $data = new DateTime($row->dtcomentario);
                            $dataComent = $data->format('d/m/Y H:m');

                            //se o comentário estiver editado
                            if($row->status_edicao == true){
                                //adicionando a identificação do comentario para realizar pesquisa
                                $idcomentario = $row->idcoments;

                                //seleciona a tabela de edições
                                $linha = mysql_query("SELECT dtedition, dsedition FROM editions WHERE idcoments = '$idcomentario' AND status_edition = false");

                                if(mysql_num_rows($linha) == 1){
                                    $l =  mysql_fetch_object($linha);

                                    //formata a data da edição do comentario
                                    $data = new DateTime($l->dtedition);
                                    $dataEdit = $data->format('d/m/Y H:m');

                                    echo    '<div class="comentario">
                                            <p class="coment">' . $l->dsedition . '</p>
                                            <figure class="perfil">
                                                <img src="img/' . $row->foto . '" />
                                                <figcaption>
                                                    <p>' . $row->nome . '</p>
                                                    <p>' . $dataComent . '</p>
                                                    <p><small>Editado: ' . $dataEdit . '</small>
                                                    </p>
                                                </figcaption>
                                            </figure>
                                            <div id="a">
                                                <a class="coment" href="'. $row->idcoments . '" id="excluir">Excluir</a>
                                                <a class="coment" href="' . $row->idcoments . '" id="editar">Editar</a>
                                            </div>
                                        </div>';
                                }
                            }
                            //se o o comentário não estiver editado
                            else{
                            echo    '<div class="comentario">
                                    <p class="coment">' . $row->dscomentario . '</p>
                                    <figure class="perfil">
                                        <img src="img/' . $row->foto . '" />
                                        <figcaption>
                                            <p>' . $row->nome . '</p>
                                            <p>' . $dataComent . '</p>
                                        </figcaption>
                                    </figure>
                                    <div id="a">
                                        <a class="coment" href="'. $row->idcoments . '" id="excluir">Excluir</a>
                                        <a class="coment" href="' . $row->idcoments . '" id="editar">Editar</a>
                                    </div>
                                </div>';
                        }                
                    }
                }
                //se o select voltar vazio
                else{
                    echo '<h3>Não há comentários</h3>';
                }
            ?>
    </section>
        
        <footer>
            <?php $s->rodape(); ?>
        </footer>
        
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
    </body>
</html>
