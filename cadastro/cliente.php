<?php

require_once "../bibliotecas/mysqli.bli";
require_once "../bibliotecas/conecta_mysqli.inc";
require_once "../bibliotecas/ver_session.inc";

if(isset($_POST["enviar"])) {
    $tabela = "cliente";
    $valores = [
        "CEP" => $_POST["cep"],
        "No_Cmplt" => $_POST["no_cmplt"],
        "Rua" => $_POST["rua"],
        "Bairro" => $_POST["bairro"],
        "Apelido" => $_POST["apelido"],
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
        <h1>Cliente</h1>
        <hr>
        <form action="cliente.php" method="POST">
        <br><label>CEP:                     </label> <input type="text" name="cEP" placeholder="Digite seu CEP">
                            <br><label>Número de Complemento:   </label> <input type="text" name="no_cmplt" placeholder="Nº999" size="1" maxlength="3" min="1">
                            <br><label>Rua:                     </label> <input type="text" name="rua" placeholder="Digite o nome da sua rua">
                            <br><label>Bairro:                  </label> <input type="text" name="bairro" placeholder="Digite o nome da sua bairro">
                            <br><label>Apelido:                 </label> <input type="text" name="apelido" placeholder="Insira algum apelido">
            <br><input type="submit" name="enviar" value="Enviar">
        </form>
        <br><a href="../">Voltar</a>
    </body>
</html>