<?php

require_once "../bibliotecas/mysqli.bli";
require_once "../bibliotecas/conecta_mysqli.inc";
require_once "../bibliotecas/ver_session.inc";

if(isset($_POST["enviar"])) {
    $tabela = "pedido";
    $valores = [
        "Data" => $_POST["data"],
        "Pag" => $_POST["pag"],
        "clid_id" => "1"
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
        <h1>Pedidos</h1>
        <hr>
        <form action="pedido.php" method="POST">
        <br><label>Data da Venda:       </label><input type="date" name="data" min="19<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" max="20<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" required>
            <br><label>Método de Pagamento: </label>
                <select name="pag">
                    <option value="Boleto">Boleto</option>
                    <option value="Cartão de Crédito">Cartão de Crédito</option>
                    <option value="Pix">Pix</option>
                </select>
            <br><input type="submit" name="enviar" value="Enviar">
        </form>
        <br><a href="../">Voltar</a>
    </body>
</html>