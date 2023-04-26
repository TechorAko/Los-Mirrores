<?php

require_once "../bibliotecas/mysqli.bli";
require_once "../bibliotecas/conecta_mysqli.inc";
require_once "../bibliotecas/ver_session.inc";

if(isset($_POST["enviar"])) {
    $tabela = "avaliacao";
    $valores = [
        "Stars" => $_POST["estrelas"],
        "Desc" => $_POST["descricao"],
        "user_id" => "58",
        "prod_id" => "9"
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
        <h1>Avalição</h1>
        <hr>
        <form action="avaliacao.php" method="POST">
            Estrelas: <input type="number" name="estrelas" min="0" max="5" placeholder="5"><br>
            Descrição: <br>
            <textarea name="descricao" cols="20" rows="5"></textarea>
            <br><input type="submit" name="enviar" value="Enviar">
        </form>
        <br><a href="../">Voltar</a>
    </body>
</html>