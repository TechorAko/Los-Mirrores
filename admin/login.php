<?php

    session_start();
    require_once "../bibliotecas/mysqli.bli";
    require_once "../bibliotecas/conecta_mysqli";

    if(isset($_REQUEST["invalid"])) {
        $alert = ["content" => "<b>Erro:</b> Acesso negado, o usuário é inválido. Tente novamente com uma conta de administrador.", "context" => "danger"];
    }

    if(isset($_REQUEST["sair"]) && $_REQUEST["sair"] == 0) {
        session_unset();
        session_destroy();
        header('Location: '. 'login.php?sair=1');
        die();
    } else if (isset($_REQUEST["sair"]) && $_REQUEST["sair"] == 1) {
        $alert = ["content" => "Você saiu da sua conta.", "context" => "warning"];
    }

    if(isset($_POST["email"]) && isset($_POST["pwd"])) {

        $login = $_POST["email"];
        $senha = $_POST["pwd"];

        $sql = "SELECT ID, Email, Senha FROM usuario WHERE Email = '$login'";
        $result = $con->query($sql);
        $data = $result->fetch_array(MYSQLI_ASSOC);

        if(isset($data) && $login == $data["Email"] && $senha == $data["Senha"]) {
            $_SESSION["user_id"] = $data["ID"];
            header('Location: ./');
            die();
        } else { $alert = ["content" => "<b>Erro:</b> Email e/ou senha errado(s). Por favor, tente novamente.", "context" => "danger"]; }
    }

    if(isset($_SESSION["user_id"])) { header('Location: '. 'index.php'); die(); }

?>

<html>
    <head>
        <title>Entrar - Los Mirrores (Administração)</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <?php include '../bibliotecas/bootstrap.html'; ?>
    </head>
    <body class="bg-lightgray">
        <?php include 'header.php'; ?>
        <div class="container bg-light" style="width: 500px; padding: 25px; margin-top: 15px;">
            <div class="container d-flex justify-content-center"><h3>Olá, Administrador!</h3></div>
            <div class="container d-flex justify-content-center"><h4>Por favor, entre com sua conta.</h4></div>
            <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" placeholder="Enter email" id="email" name="email">
                </div>
                <div class="form-group">
                  <label for="pwd">Senha:</label>
                  <input type="password" class="form-control" placeholder="Enter password" id="pwd" name="pwd">
                </div>
                <div style="margin-top: 55px; margin-bottom: 45px; text-align: center;"><button type="submit" class="btn btn-primary">Entrar</button></div>
              </form>
        </div>
    </body>
</html>
