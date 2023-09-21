<?php
        //PASSO1 - criar variaveis com os dados do banco de dados e inserir na variavel $conecta, dentro do atributo mysqli_connect
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "andes";
    $conecta = mysqli_connect($servidor, $usuario, $senha, $banco);

    // PASSO2
    if (mysqli_connect_errno()) {
        die("Conexão falhou: " . mysqli_connect_errno() );
    }
?>