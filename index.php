<?php

include "bibliotecas/conecta_mysqli.inc";
include "bibliotecas/ver_session.inc";

?>

<html>
    <head>
        <title>Área Administrativa</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Área Administrativa</h1>
        <hr>
        <a href="admin.php">Acessar</a>
        <br>
        <br><a href="cadastro.php">Cadastro</a>
        <br><a href="alterar">Alterar</a>
        <br><a href="excluir">Excluir</a>
        <br><a href="buscar">Buscar</a>
        <br>
        <br><a href="login.php?sair=1">Sair</a>
    </body>
</html>