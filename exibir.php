<?php

require_once "bibliotecas/mysqli.bli";
require_once "bibliotecas/conecta_mysqli.inc";
require_once "bibliotecas/ver_session.inc";

if(isset($_GET["table"])) { $table = $_GET["table"]; } else { header('Location: '. $_SERVER['PHP_SELF'] .'?table='. $ecommerce->tabelas[0]); die(); }
if(isset($_REQUEST["edit"])) {
    foreach($ecommerce->descrever($table) as $atributo) { // Pega todos os valores anteriormente enviados pelo formulário e os insere dentro de um array.
        $atributo = $atributo["Field"];
        $edit[$atributo] = $_POST[$atributo];
    }

    switch($_REQUEST["edit"]) {
        case "Alterar":
            setcookie("edit", serialize($edit));
            header("Location: cadastro.php?table=$table&edit=1");
            die();
            break;
        case "Excluir":
            $data["ID"] = $edit["ID"];
            $ecommerce->excluir($table, $data);
            break;
        default:
    }
}
if(isset($_GET["search"])) { $search[$_GET["ref"]] = $_GET["search"]; } else { $search = NULL; }

?>
<html>
    <head>
        <title>Área Administrativa</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <style>
            table { width: 85%; }
            table, tr, td, th {
                border: 1px solid;
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
                    foreach ($atributos as $atributo) { ?> <th><?=$atributo["Field"]?></th> <?php }
                ?>
                <th>Opções</th>
            </tr>
                <?php 
                    $data = $ecommerce->buscar($table, "*", $search, TRUE);
                    if(is_array($data) == TRUE) { // Verifica se há algo nos registros.
                        foreach ($data as $linha) { // Para cada linha da linha, será uma linha da tabela.
                            ?><form action="<?= $_SERVER['PHP_SELF'] . "?table=$table" ?>" method="POST"> <tr> <?php
                                foreach ($linha as $atributo => $registro) { // Para cada linha, conterá uma série de registros. ?>
                                    <td><?=$registro?></td>
                                    <input type="hidden" name="<?=$atributo?>" value="<?=$registro?>">
                                    <?php } // Acima, ele irá inserir dentro da tabela os registros e criará um formulário para enviar esses dados para quaisquer ações do usuário ?>
                                <td><input type="submit" name="edit" value="Alterar"> <input type="submit" name="edit" value="Excluir"></td>
                            </tr></form> <?php
                        }
                    } else { ?><td colspan="100" style="text-align: center;"><?=$data?></td><?php } // Mensagem que será exibida caso não houverem registros.
                ?>
            <tr>
                <td colspan="100" style="text-align: center;">
                    <form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
                        <input type="hidden" name="table" value="<?=$table?>">
                        <input type="text" size="25" name="search"> <select name="ref"> <?php 
                                foreach($atributos as $atributo) { ?> <option value="<?=$atributo["Field"]?>"><?=$atributo["Field"]?></option> <?php }
                        ?> </select>
                        <input type="submit" value="Pesquisar">
                    </form>
                </td>
            </tr>
        </table>
        <br>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
            <select name="table"> <?php
                foreach($ecommerce->tabelas as $tabelas) { ?><option value="<?=$tabelas?>" <?php if($table == $tabelas) { echo "selected"; } ?>><?=$tabelas?></option><?php } ?>
            </select>
            <input type="submit" value="Trocar">
        </form>
        <a href="./">Voltar</a>
    </body>
</html>