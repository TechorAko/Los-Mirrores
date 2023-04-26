<?php

require_once "bibliotecas/mysqli.bli";
require_once "bibliotecas/conecta_mysqli.inc";
require_once "bibliotecas/ver_session.inc";

/*

$nome_da_tabela = "nome_da_tabela";
$valores = [
    "Nome do Atributo 1" => "Valor 1 que o atributo será inserido".
    "Nome do Atributo 2" => "Valor 2 que o atributo será inserido".
    "Nome do Atributo 3" => "Valor 3 que o atributo será inserido".
    "Nome do Atributo 4" => "Valor 4 que o atributo será inserido".
    "Nome do Atributo 5" => "Valor 5 que o atributo será inserido".
    "Nome do Atributo 6" => "Valor 6 que o atributo será inserido".
    "Nome do Atributo 7" => "Valor 7 que o atributo será inserido".
    "Nome do Atributo ..." => "Valor ... que o atributo será inserido".
];

$ecommerce->inserir($nome_da_tabela, $valores);

*/

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
        <br><a href="cadastro/">Cadastro</a>
        <br><a href="exibir.php">Exibir</a>
        <br>
        <br><a href="login.php?sair=1">Sair</a>
    </body>
</html>