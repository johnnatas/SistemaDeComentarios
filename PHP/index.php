<!DOCTYPE html>
<?php
    session_start();
    require_once 'classes/Banco.php';
    $b = new Banco();
    require_once 'classes/Sistema.php';
    $s = new Sistema();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema</title>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/index.css"/>
        
    </head>
    <body>
        <!-- cabeçalho -->
        <header>
        <?php
            if(!isset($_SESSION['email']) && !isset($_SESSION['senha'])){
                $s->cabecalho();
            }else{
                $s->cabecalhoLogado();
            }
        ?>
        </header>
        
        <!-- seção produto -->
        <section id="produto">
            <!-- produto -->
            <h1 id="txt">Estamos lançando mais um novo produto</h1><br />
            <p id="txt">Nós da ArrayEnterprise, gostaríamos que você consumidor comentasse sua opinião sobre o nosso produto
               para que possamos entender o que é necessário para que o produto chegue com a melhor qualidade, e funcione
               com a maior eficiência para você consumidor. É válido criticar, opinar, e elogiar, estamos dispostos a ouvir
               você.<br /><br />
               Para que você possa comentar, é necessário realizar um cadastro aqui no site. Vá no menu e clique em cadastrar,
               logo depois será enviado em e-mail de confirmação de cadastro, logo após estará apto a logar no sitema e comentar
               sua opinião.
            </p>
            
            <div id="imagem-produto">
                <figure class="img">
                    <img src="img/produto.jpg" />
                    <figcaption>
                        <h3>Produto ArrayEntrepises</h3>
                        <p>O novo produto com a melhor qualidade</p>
                    </figcaption>
                </figure>
            </div>
        </section>

        <!-- seção comentários -->
        <section id="comentarios">
            
            <div id="comentar">
            <?php  
                    if(isset($_SESSION['email']) && isset($_SESSION['senha'])){
                        echo     '   <textarea id="comentario" name="comentario" placeholder="Escreva seu comentário..."></textarea>
                                    <p id="notcoment" display="none">Comentário vazio não pode ser enviado</p>
                                     <input id="enviar" type="submit" value="Enviar" />'; 
                        //ao clicar em enviar toda a ação de inserir o comentario é realizada na arquivosphp/action.php
                    }
            ?>
            </div>

            <!-- lista de comentarios -->
            <div id="lscomentarios">
                
                <h2>Comentários:</h2>
                
                <div id="novo-comentario">
                    
                </div>
                
            <?php
                    $r = mysql_query("SELECT * FROM comentario");
                    
                    if(mysql_num_rows($r) > 0){
                        while ($row = mysql_fetch_object($r)){
                            
                            //formata a data do comentario;
                            $data = new DateTime($row->dataComentario);
                            $dataComent = $data->format('d/m/Y H:m');

                            //se o comentário estiver editado
                            if($row->statusEdicao == true){
                                //adicionando a identificação do comentario para realizar pesquisa
                                $idcomentario = $row->idcomentario;

                                //seleciona a tabela de edições
                                $linha = mysql_query("SELECT dtedition, dsedition FROM editions 
                                                    WHERE idcoments = '$idcomentario' AND status_edition = false");

                                if(mysql_num_rows($linha) == 1){
                                    $l =  mysql_fetch_object($linha);

                                    //formata a data da edição do comentario
                                    $data = new DateTime($l->dtedition);
                                    $dataEdit = $data->format('d/m/Y H:m');

                                    echo    '<div id="comentario">
                                            <p id="coment">' . $l->dsedition . '</p>
                                            <figure class="perfil">
                                                <img src="img/' . $row->foto . '" />
                                                <figcaption>
                                                    <p>' . $row->nome . '</p>
                                                    <p>' . $dataComent . '</p>
                                                    <p><small>Editado: ' . $dataEdit . '</small>
                                                    </p>
                                                </figcaption>
                                            </figure>
                                        </div>';
                                }
                            }
                            //se o o comentário não estiver editado
                            else{
                            echo    '<div id="comentario">
                                    <p id="coment">' . $row->comentario . '</p>
                                    <figure class="perfil">
                                        <img src="img/' . $row->foto . '" />
                                        <figcaption>
                                            <p>' . $row->nome . '</p>
                                            <p>' . $dataComent . '</p>
                                        </figcaption>
                                    </figure>
                                </div>';
                        }                
                    }
                }
                //se o select voltar vazio
                else{
                    echo '<h3>Não há comentários</h3>';
                }
            ?>
            </div>
            
        </section>
        
        <footer>
            <?php $s->rodape(); ?>
        </footer>
        
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
</html>
