<?php

class Banco {
    
    private $comando;
    
    //faz a conexão com o banco de dados
    public function __construct(){
        $host = "localhost";
        $user = "root";
        $pass = "";
        $database = "db_sistema";
        
        $conexao = mysql_connect($host, $user, $pass) or die (mysql_error());
        mysql_select_db($database, $conexao);
    }
    
    private function executar($query){
        mysql_query($query);
    }
    
    function getComando() {
        return $this->executar($this->comando);
    }
    
    function setComando($comando){
        $this->comando = $comando;
    }
}
