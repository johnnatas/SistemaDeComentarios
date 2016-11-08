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
        <link rel="stylesheet" href="css/cadastrar.css"/>
    </head>
    <body>
        <!-- cabeçalho -->
        <header>
            <?php
                $s->cabecalho();
            ?>
        </header>
        
        <!-- seção cadastrar -->
        <section id="cadastrar">
            <h1>Cadastre-se em nosso sistema</h1>
            <form id="cadastrar" method="post" action="">
                <input id="nome" type="text" name="nome" placeholder="Nome" class="txt" />
                <input id="email" type="email" name="email" placeholder="E-mail" class="txt" />
                <input id="senha" type="password" name="senha" placeholder="Senha" class="txt" />
                <input id="repetirS" type="password" name="repetirsenha" placeholder="Repita a senha" class="txt" />
                <input id="cadastrar" type="submit" name="cadastrar" value="Cadastrar" />
                <?php if(isset($_POST['cadastrar'])) {
                    $u = new Usuario($_POST['nome'], $_POST['email'], $_POST['senha']);
                    $u->cadastrar($u->getNome(), $u->getEmail(), $u->getSenha());
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
