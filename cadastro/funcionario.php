<?php

require_once "../bibliotecas/mysqli.bli";
require_once "../bibliotecas/conecta_mysqli.inc";
require_once "../bibliotecas/ver_session.inc";

if(isset($_POST["enviar"])) {
    $tabela = "funcionario";
    $valores = [
        "Cargo" => $_POST["cargo"],
        "Salario" => $_POST["salario"],
        "Admissao" => $_POST["admissao"],
     
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
        <h1>Funcionario
            
        </h1>
        <hr>
        <form action="funcionario.php" method="POST">
        <label>Cargo: </label>
            <select name="Cargo">
                <option value="Gerente">Gerente</option>
                <option value="RH">RH</option>
                <option value="Mercadologo">Mercadólogo</option>
                <option value="Vendedor">Vendedor</option>
            </select>
            <br><label>Salário:             </label><input type="number" name="salario" step="0.01" placeholder="1000.00" min="0" max="9999999" required>
            <br><label>Data de Admissão:    </label><input type="date" name="admissao" min="19<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" max="20<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" required>
                 <br>
            <br><input type="submit" name="enviar" value="Enviar">
        </form>
        <br><a href="../">Voltar</a>
    </body>
</html>