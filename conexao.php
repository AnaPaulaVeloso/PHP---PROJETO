<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "produtobd";


try{
    $conn = new PDO("mysql:host$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Banco Conectado";

    //Criando o banco de dados caso ele n exista
    $exists = $conn->prepare("CREATE DATABASE IF NOT EXISTS produtobd;");
    $exists-> execute();


    //adicionar bando de dados à conexão
    $conn = new PDO("mysql:host$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //criando as tabelas caso elas não existam 
    if ($exists){
        $createTableUsuario = $conn->prepare("CREATE TABLE  IF NOT EXISTS USUARIO(
            cd_usuario INTEGER PRIMARY KEY auto_incriment,
            nm_usuario varchar(50) NOT NULL,
            nm_email varchar(100) NOT NULL,
            cd_senha varchar(250) NOT NULL,
            CONSTRAINT un_email unique(nm_email)
            );");
    }
}catch(PDOException $e){
    echo "Connection Failed: " . $e->getMessage(); 
}

?>