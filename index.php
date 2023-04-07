<?php

include "conecta_mysqli.inc";

print_r($ecommerce->selecionar_tudo("usuario"));

die();

session_start();
if(!isset($_SESSION["user_id"])) { header('Location: '.'login.php'); die(); }

?>

<html>
    <head>
        <title>Área Administrativa</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <a href="admin.php">Acessar</a>
        <br>
        <br><a href="cadastro">Cadastro</a>
        <br><a href="alterar">Alterar</a>
        <br><a href="excluir">Excluir</a>
        <br><a href="buscar">Buscar</a>
        <br>
        <br><a href="login.php?sair=1">Sair</a>
    </body>
</html>