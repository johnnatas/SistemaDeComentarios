<?php    
//incluso em perfil.php
    if(isset($_POST['upload'])) {
        $imagem = $_FILES['foto']['name'];
        $u->setFoto($imagem);
        $u->alterarFotoPerfil($u->getFoto(), $u->getUsuario());
    }else if(isset($_POST['remover'])){
        $imagem = "perfil-default.png";
        $u->setFoto($imagem);
        $u->alterarFotoPerfil($u->getFoto(), $u->getUsuario());
    }