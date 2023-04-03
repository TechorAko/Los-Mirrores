<?php

include "biblioteca/mysqli.php";

$table = "usuario";
$atributos = atributos($table);

?>

<html>
    <head>
        <title>Area Administrativa</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <style>
            table {
                width: min-content; height: min-content;
                margin-left: auto; margin-right: auto;
            }
            table, tr, th, td {
                border: 1px solid gray;
                border-collapse: collapse;
                text-align: center;
                padding: 10px;
            }
            th {text-align: left; padding-left: 15px;}
            .header {text-align: left; padding-left: 15px;}
        </style>
    </head>
    <body>
        <h1 class="header">Area Administrativa</h1>
        <hr>
        <table>
            <tr>
                <th colspan="<?=count($atributos)?>">
                    <?=$table?>
                </th>
            </tr>
            <tr>
                <?php
                    foreach($atributos as $atributo) { ?>
                    <td><?=$atributo?></td>
                <?php } ?>
            </tr>
            <?php

                foreach(descrever($table, ["*"]) as $valor) {?>
            <tr>
                <td><?=$valor?></td>
            </tr>
            <?php } ?>
        </table>
        <br>
        <a href="cadastro.php">Cadastrar</a>
        <p style="text-align: right; padding-right: 5px;">AKORA EXIS © <?=date("Y");?></p>
    </body>
</html>