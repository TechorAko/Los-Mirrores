<?php

require_once "bibliotecas/mysqli.bli";
require_once "bibliotecas/conecta_mysqli.inc";
require_once "bibliotecas/ver_session.inc";

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
        <br><a href="exibir.php">Exibir</a>
        <br>
        <br><a href="login.php?sair=1">Sair</a>
    </body>
</html>