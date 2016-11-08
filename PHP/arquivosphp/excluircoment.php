<?php

session_start();
    if(!isset($_SESSION['email']) && !isset($_SESSION['senha'])){
        header('Location: index.php');
    }else{
        $email = $_SESSION['email'];
        $senha = $_SESSION['senha'];
        $nome = $_SESSION['nome'];
}

//carregando classes no arquivo
require_once '../classes/Banco.php';
$b = new Banco();
require_once '../classes/Comentario.php';
$c = new Comentario($nome, $email, $senha);

$idcoments = $_POST['id'];

$c->setId($idcoments);
$c->excluirComentario($c->getId());