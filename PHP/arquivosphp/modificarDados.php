<?php
    
    if(isset($_POST['alt-email'])){
        $novoEmail = $_POST['novoemail'];
        $u->alterarDados($novoEmail, $senha, $usuario);
        
    }else if(isset ($_POST['alt-senha'])){
        $senhaAtual = sha1(md5($_POST['senhaatual']));
        if($senhaAtual != $senha){
            echo '<script> alert("Senha Inválida"); </script>';
        }else{
            $novaSenha = sha1(md5($_POST['novasenha']));
            $u->alterarDados($email, $novaSenha, $usuario);
        }
    }

