<?php
require_once 'Usuario.php';
class Comentario extends Usuario {
    private $texto;
    private $id;
    private $idedicao;

    function getIdedicao(){
        return $this->idedicao;
    }

    function getId(){
        return $this->id;
    }

    function getTexto() {
        return $this->texto;
    }

    function setIdedicao($idedicao){
        $this->idedicao = $idedicao;
    }

    function setId($id){
        $this->id = $id;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }
}
