<?php
require_once 'Banco.php';

class Usuario {
    private $usuario;
    private $nome;
    private $email;
    private $senha;
    private $foto;

    //recebe as informações de um usuário
    public function __construct($nome, $email, $senha) {
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setSenha(sha1(md5($senha))); //senha criptografada
    }
    
    //realiza o cadastro de um usuário
    public function cadastrar($nome, $email, $senha){
        $b = new Banco();
        $b->setComando("INSERT INTO users VALUES (default, '$nome', '$email', '$senha', default)");
        $b->getComando();
        header("Location: logar.php");
    }
    
    //permite o usuário acessar o sistema
    public function logar($email, $senha){

        $log = mysql_query("SELECT * FROM users WHERE email = '$email' and senha = '$senha'");

        if(mysql_num_rows($log) == 1){
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            
            $row = mysql_fetch_object($log);
            $_SESSION['nome'] = $row->nome;
            $_SESSION['foto'] = $row->foto;
            $_SESSION['id'] = $row->idusers;
            if($email == "admin@sistema.com"){
                header("Location: admin.php");
            }
            else{
                header('Location: index.php');
            }
        }else{
            echo '<p id="failog">E-mail ou senha incorretos</p>';
        }
    }
    
    //insere um novo comentário
    public function comentar($comentario, $usuario) {
        $b = new Banco();
        $b->setComando("INSERT INTO coments VALUES(null, '$comentario', default, default, '$usuario')");
        $b->getComando();
    }

    //exclui um comentario feito pelo usuário
    public function excluirComentario($idcoments){
        $b = new Banco();
        $b->setComando("DELETE FROM editions WHERE idcoments = '$idcoments'");
        $b->getComando();
        $b->setComando("DELETE FROM coments WHERE idcoments = '$idcoments'");
        $b->getComando();
    }

    //edita um comentario do usuario
    public function editarComentario($idcoments, $idedition, $comentario){
        $b = new Banco();
        $row = mysql_query("SELECT status_edicao FROM coments WHERE idcoments = '$idcoments'");
        if(mysql_num_rows($row) == 1){
            $r = mysql_fetch_object($row);
            if($r->status_edicao == true){
                    $b->setComando("UPDATE editions SET status_edition = 1 WHERE idedition = '$idedition'");
                    $b->getComando();
                    echo $idedition;
                    $b->setComando("INSERT INTO editions values (default, '$idcoments', NOW(), '$comentario', default)");
                    $b->getComando();
                    header("Location: ../perfil.php");
            }
            else{
                    $b->setComando("UPDATE coments SET status_edicao = 1 WHERE idcoments = '$idcoments'");
                    $b->getComando();
                    $b->setComando("INSERT INTO editions values (default, '$idcoments', NOW(), '$comentario', default)");
                    $b->getComando();
                    header("Location: ../perfil.php");   
            }
        }
    }
    
    //faz modificação na foto do usuário
    public function alterarFotoPerfil($imagem, $usuario) {
        $b = new Banco();
        
        if($imagem == "perfil-default.png"){ //remove a imagem
            $b->setComando("UPDATE users SET foto = '$imagem' WHERE idusers = '$usuario'");
            $b->getComando();
            $_SESSION['foto'] = $imagem;
            header("Location: perfil.php");
            
        }else{ // atualiza e imagem de perfil
            
            $diretorio = "img/" . basename($imagem);

            if(move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio)){
                $_SESSION['foto'] = $imagem;
                $b->setComando("UPDATE users SET foto = '$imagem' WHERE idusers = '$usuario'");
                $b->getComando();
                header("Location: perfil.php");
            }else{
                echo 'Por favor, esolha uma imagem';
            }
        }
    }
    
    //modifica os dados do usuário, seu email ou sua senha
    public function alterarDados($email, $senha, $usuario){
        $b = new Banco();
        
        //se for pra alterar o e-mail do usuário
        if($email != $this->email){
            
            //vertifica se já existe algum e-mail registrado
            $row = mysql_query("SELECT email FROM users WHERE email = '$email'");
            if(mysql_num_rows($row) > 0){
                echo '<script> alert("Este e-mail já está cadastrado"); </script>';
            }else{ //caso o e-mail ainda não esteja registrado então é realizada a atualização
                $b->setComando("UPDATE users SET email = '$email' WHERE idusers = '$usuario'");
                $b->getComando();
                $_SESSION['email'] = $email;
                header("Location: perfil.php");
            }
        } else if($email == $this->email){ //se o e-mail for igual então altera a senha            
            $b->setComando("UPDATE users SET senha = '$senha' WHERE idusers = '$usuario'");
            $b->getComando();
            $_SESSION['senha'] = $senha;
            echo '<script> alert("Senha alterada com sucesso"); </script>';
        }
    }
    
    //Getters e Setters
    
    function getUsuario(){
        return $this->usuario;
    }
    
    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getSenha() {
        return $this->senha;
    }
    
    function getFoto() {
        return $this->foto;
    }

    function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    
    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }
    
    function setFoto($foto){
        $this->foto = $foto;
    }


}
