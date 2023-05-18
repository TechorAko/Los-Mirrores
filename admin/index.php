<?php

require_once "../bibliotecas/mysqli.bli";
require_once "../bibliotecas/conecta_mysqli";
require_once "ver_session";

// Resgatando o nome do usuário.

$sql = "SELECT `Nome` FROM `usuario` WHERE `usuario`.`ID` = '". $_SESSION["user_id"] ."'";
$resultado = $con->query($sql);
$username = $resultado->fetch_array(MYSQLI_ASSOC)["Nome"];

// Mensagem easter egg.

if(str_contains($username, "Gabriel") || str_contains($username, "Owen")) { $message = "Pronto para reescrever este sistema novamente?"; }
else if (str_contains($username, "Otávio")) { $message = "Tem certeza que quer se aprofundar nessa loucura? Ou já não há opções para você?"; }
else if (str_contains($username, "Leo") || str_contains($username, "Odranoel")) { $message = "Vamos cadastrar alguns... Não? Veio para tentar entender essa bagunça? Pshh. Boa sorte."; }
else if (str_contains($username, "Carla")) { $message = "Bom dia, esperamos que você tenha uma boa estadia em nosso querido site."; }
else { $message = "Pronto para gerenciar o sistema?";}

?>

<html>
    <head>
        <title>Administração - Los Mirrores</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <?php include '../bibliotecas/bootstrap.html'; ?>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="container" style="margin: 25px">
            <h4>Olá, <?=$username?>. <?=$message?></h4>
            <div class="row">
            <div class="col-lg-3"></div>
        </div>
    </body>
</html>