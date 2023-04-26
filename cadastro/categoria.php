<?php

require_once "../bibliotecas/mysqli.bli";
require_once "../bibliotecas/conecta_mysqli.inc";
require_once "../bibliotecas/ver_session.inc";

if(isset($_POST["enviar"])) {
    $tabela = "categoria";
    $valores = [
        "Nome" => $_POST["nome"],
        "Desc" => $_POST["descricao"],
    ];
    if($ecommerce->inserir($tabela, $valores)) {
        echo "Funcionou";
    } else { echo "Não funcionou"; }
}

?>

<html>
    <head>
        <title>Área Administrativa</title>
        <link rel="stylesheet" href="../style.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Categoria</h1>
        <hr>
        <form action="categoria.php" method="POST">
            Nome: <br>
            <textarea name="nome" cols="20" rows="2"></textarea><br>
            Descrição: <br>
            <textarea name="descricao" cols="20" rows="5"></textarea>
            <br><input type="submit" name="enviar" value="Enviar">
        </form>
        <br><a href="../">Voltar</a>
    </body>
</html>