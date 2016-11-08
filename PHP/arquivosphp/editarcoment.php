<?php

//incluindo todos os dados do usuario
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

$idcoments = $_POST['idcomentario'];
$idedition = $_POST['idedicao'];
$comentario = $_POST['comentario'];

$c->setId($idcoments);
$c->setIdedicao($idedition);
$c->setTexto($comentario);

$c->editarComentario($c->getId(), $c->getIdedicao(), $c->getTexto());