<?php

include "bibliotecas/conecta_mysqli.inc";
include "bibliotecas/ver_session.inc";

if(isset($_GET["table"])) { $table = $_GET["table"]; } else { header('Location: '. $_SERVER['PHP_SELF'] .'?table='. $ecommerce->tabelas[0]); die(); }
if(isset($_POST["edit"])) {
    foreach($ecommerce->descrever($table) as $atributo) { $form[$atributo] = $_POST[$atributo]; } // Pega todos os valores anteriormente enviados pelo formulário e os insere dentro de um array.

    switch($_POST["edit"]) {
        case "Alterar":
            echo $_POST["edit"];
            break;

        case "Excluir":
            reset($form);
            if($ecommerce->excluir($table, key($form), $form[key($form)])) { echo "Registro excluído com sucesso."; }
            else { echo "Falha em excluir o registro."; }
            break;

        default:
    }
}
if(isset($_GET["search"])) { $search = $_GET["search"]; $ref = $_GET["ref"]; }

?>
<html>
    <head>
        <title>Área Administrativa</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <style>
            table { width: 85%; }
            table, tr, td, th {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <h1>Área Administrativa</h1>
        <hr><br>
        <table align="center">
            <tr><th colspan="100"><?=$table?></th></tr>
            <tr>
                <?php
                    $atributos = $ecommerce->descrever($table);
                    foreach ($atributos as $atributo) { ?> <th><?=$atributo?></th> <?php }
                ?>
                <th>Opções</th>
            </tr>
                <?php 
                    if(!isset($search)) { $data = $ecommerce->exibir($table); } else { $data = $ecommerce->buscar_como($table, $atributos, $ref, $search); } // Se houver uma pesquisa, exibirá somente os registros da pesquisa.
                    if(is_string($data) != 1) { // Verifica se há algo nos registros.
                        foreach ($data as $linha) { // Para cada linha da linha, será uma linha da tabela.
                            ?><form action="<?= $_SERVER['PHP_SELF'] . "?table=$table" ?>" method="POST"> <tr> <?php
                                foreach ($linha as $atributo => $registro) { // Para cada linha, conterá uma série de registros. ?>
                                    <td><?=$registro?></td>
                                    <input type="hidden" name="<?=$atributo?>" value="<?=$registro?>">
                                    <?php } // Acima, ele irá inserir dentro da tabela os registros e criará um formulário para enviar esses dados para quaisquer ações do usuário ?>
                                <td><input type="submit" name="edit" value="Alterar"> <input type="submit" name="edit" value="Excluir"></td>
                            </tr></form> <?php
                        }
                    } else { ?><td colspan="100" style="text-align: center;">Nenhum registro encontrado.</td><?php } // Mensagem que será exibida caso não houverem registros.
                ?>
            <tr>
                <td colspan="100" style="text-align: center;">
                    <form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
                        <input type="hidden" name="table" value="<?=$table?>">
                        <input type="text" size="25" name="search"> <select name="ref"> <?php
                                foreach($atributos as $atributo) { ?> <option value="<?=$atributo?>"><?=$atributo?></option> <?php }
                        ?> </select>
                        <input type="submit" value="Pesquisar">
                    </form>
                </td>
            </tr>
        </table>
        <br>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
            <select name="table"> <?php
                foreach($ecommerce->tabelas as $tabelas) { ?><option value="<?=$tabelas?>" <?php if($table == $tabelas) { echo "selected";} ?>><?=$tabelas?></option><?php } ?>
            </select>
            <input type="submit" value="Trocar">
        </form>
        <a href="./">Voltar</a>
    </body>
</html>