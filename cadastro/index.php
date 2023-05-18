<?php

require_once "../bibliotecas/mysqli.bli";
require_once "../bibliotecas/conecta_mysqli.inc";
require_once "../bibliotecas/ver_session.inc";

?>

<html>
    <head>
        <title>Área Administrativa</title>
        <link rel="stylesheet" href="../style.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Cadastro</h1>
        <hr>
        <br><a href="../cadastro.php">Painel</a>
        <br>
        <?php
            foreach($ecommerce->tabelas as $tabela) {
                ?><br><a href="<?=$tabela?>.php"><?=$tabela?></a><?php
            }
        ?>
        <br>
        <br><a href="../">Voltar</a>
    </body>
</html>