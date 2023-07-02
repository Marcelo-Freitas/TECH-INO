<?php

    $msgErro = "";
    $msgSucesso = "";

    $email = "";
    $senha = "";
    $confirmSenha = "";
    $endereco = "";
    $cidade = "";
    $estado = "";
    $cep = "";
    $termos = "";

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    require_once("Connection.php");

    $conn = Connection::getConnection();

    if(isset($_POST['submetido'])) {
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : null;
        $confirmSenha = isset($_POST['confirmSenha']) ? trim($_POST['confirmSenha']) : null;
        $endereco = isset($_POST['endereco']) ? trim($_POST['endereco']) : null;
        $cidade = isset($_POST['cidade']) ? trim($_POST['cidade']) : null;
        $estado = isset($_POST['estado']) ? trim($_POST['estado']) : null;
        $cep = isset($_POST['cep']) ? trim($_POST['cep']) : null;
        $termos = isset($_POST['termos']) ? trim($_POST['termos']) : null;

        if (! $email) {
            $msgErro = "Informe um email válido!";
        } else if (! $senha){
            $msgErro = "Informe uma senha válida!";
        } else if ($confirmSenha != $senha) {
            $msgErro = "Confirmação de senha inválida!"; 
        } else if (! $endereco){
            $msgErro = "Informe um endereço válido!";
        } else if (! $cidade){
            $msgErro = "Informe uma cidade válida!";
        } else if (! $estado){
            $msgErro = "Informe um estado válido!";
        } else if (! $cep){
            $msgErro = "Informe um CEP válido!";
        } else if ($termos == 0){
            $msgErro = "Você precisa aceitar os termos!";
        }
        
        else {
            $msgSucesso = "Você foi registrado com sucesso!";

            $sql = 'INSERT INTO pessoas (email, senha, confirmSenha, endereco, cidade, estado, cep, termos)' . 
               ' VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = $conn->prepare($sql);
            $stmt->execute([$email, $senha, $confirmSenha, $endereco, $cidade, $estado, $cep, $termos]);

            header("location: techino_register.php");
        }
    }

?>
