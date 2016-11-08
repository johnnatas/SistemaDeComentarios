<!DOCTYPE html>
<?php
    require_once 'classes/Usuario.php';
    require_once 'classes/Banco.php';
    $b = new Banco();
    require_once 'classes/Sistema.php';
    $s = new Sistema();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/logar.css"/>
    </head>
    <body>
        <!-- cabeçalho -->
        <header>
            <?php
                $s->cabecalho();
            ?>
        </header>
        
        <!-- seção logar -->
        <section id="logar">
            <h1>Acesse o sistema aqui:</h1>
            <form id="logar" method="post" action="">
                <input id="email" type="email" name="email" placeholder="E-mail" class="txt" />
                <input id="senha" type="password" name="senha" placeholder="Senha" class="txt"/>
                <br/>
                <a id="esqueci" href="esquecisenha.php">Esqueci minha senha</a>
                <input id="acessar" type="submit" name="acessar" value="Acessar" />
                <?php if(isset($_POST['acessar'])){
                    $u = new Usuario("", $_POST['email'], $_POST['senha']);
                    $u->logar($u->getEmail(), $u->getSenha());
                } ?>
            </form>
        </section>
        
        <!-- rodapé -->
        <footer>
            <?php $s->rodape(); ?>
        </footer>
        
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        
    </body>
</html>
