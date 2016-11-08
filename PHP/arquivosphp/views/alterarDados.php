<?php
    session_start();
    $email = $_SESSION['email'];
?>
<div id="alterar">
    <?php
        if($email != "admin@sistema.com"){
        echo '<form id="alterar-email" method="POST" action="">
                <h2>Alterar E-mail</h2>
                <input class="input" type="email"  name="novoemail" placeholder="Insira o novo e-mail" /> 
                <input type="submit" name="alt-email" id="alt-email" class="alt" value="Alterar" />
            </form>';
        }
    ?>
    <form id="alterar-senha" method="POST" action="">
        <h2>Alterar Senha</h2>
        <input class="input" type="password" name="senhaatual" placeholder="Senha atual"/>
        <input class="input" type="password" name="novasenha" placeholder="Nova senha"/>
        <input class="input" type="password" name="repetirnova" placeholder="Repita nova senha" />
        <input type="submit" name="alt-senha" id="alt-senha" class="alt" value="Alterar" />
    </form>
</div>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/script.js"></script>