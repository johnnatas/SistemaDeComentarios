<?php
require_once 'interfaces/Visual.php';
class Sistema implements Visual {
    public function cabecalho() {
        echo '<nav id="menu">
                <h1>ArrayEnterprises[ ]</h1>
                <ul>
                    <li><a href="index.php">Início</a></li>
                    <li><a href="logar.php">Logar</a></li>
                    <li><a href="cadastrar.php">Cadastrar</a></li>
                </ul>
            </nav>';
    }

    public function cabecalhoLogado() {
        echo '<nav id="menu">
                <h1>ArrayEnterprises[ ]</h1>
                <ul>
                    <li><a href="index.php">Início</a></li>
                    <li><a href="perfil.php">Perfil</a></li>
                    <li><a href="logout.php">Sair</a></li>
                </ul>
            </nav>';
    }

    public function rodape() {
                $year = new DateTime('now');
                $yearModel = $year->format("Y");
                echo 'ArrayEntrepise[ ] &copy '. $yearModel . ' - Todos os direitos reservados';
    }

}
