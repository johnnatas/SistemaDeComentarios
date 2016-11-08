<?php

session_start();
    if(!isset($_SESSION['email']) && !isset($_SESSION['senha'])){
        header('Location: index.php');
    }else{
        $email = $_SESSION['email'];
        $senha = $_SESSION['senha'];
        $foto = $_SESSION['foto'];
        $nome = $_SESSION['nome'];
        $usuario = $_SESSION['id'];
        
        require_once 'classes/Usuario.php';
        $u = new Usuario($nome, $email, $senha);
        $u->setUsuario($usuario);
        $u->setFoto($foto);
    }
