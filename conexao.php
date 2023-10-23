<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "produtobd";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Banco Conectado";

    // Criando o banco de dados caso ele não exista
    $conn->exec("CREATE DATABASE IF NOT EXISTS $dbname");

    // Conectando ao banco de dados criado
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criando a tabela de usuário caso ela não exista
    $createTableUsuario = $conn->exec("CREATE TABLE IF NOT EXISTS USUARIO (
        cd_usuario INTEGER PRIMARY KEY AUTO_INCREMENT,
        nm_usuario VARCHAR(50) NOT NULL,
        nm_email VARCHAR(100) NOT NULL,
        cd_senha VARCHAR(250) NOT NULL,
        CONSTRAINT un_email UNIQUE(nm_email)
    );");
} catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}
?>
