<?php

    session_start();
    require_once "bibliotecas/mysqli.bli";
    require_once "bibliotecas/conecta_mysqli.inc";

    if(isset($_REQUEST["sair"])) {
        session_unset();
        session_destroy();
        header('Location: '. 'login.php');
        die();
    }

    if(isset($_REQUEST["enviar"])) {

        $login = $_POST["login"];
        $senha = $_POST["senha"];

        $sql = "SELECT ID, Email, Senha FROM usuario WHERE Email = '$login'";
        $result = $con->query($sql);
        $data = $result->fetch_array(MYSQLI_ASSOC);

        if(isset($data) && $login == $data["Email"] && $senha == $data["Senha"]) {
            $_SESSION["user_id"] = $data["ID"];
            header('Location: '. 'index.php');
            die();
        } else { echo "Erro: Usuário inválido."; }
    }

    if(isset($_SESSION["user_id"])) { die(); header('Location: '. 'index.php'); die(); }

?>

<html>
    <head>
        <title>Painel de Login</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <form action="login.php" method="POST">
            Olá, Usuário. Por favor, entre com sua conta.
            <br>
            <br>Login: <input type="text" name="login" placeholder="Insira um login aqui">
            <br>Senha: <input type="password" name="senha" placeholder="Insira sua senha aqui">
            <br>
            <br><input type="submit" name="enviar" value="Entrar"><br>
        </form>
    </body>
</html>
