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

        $sql = "SELECT user_id, user_email, user_senha FROM usuario WHERE user_email = '$login'";
        $result = $con->query($sql);
        $data = $result->fetch_array(MYSQLI_ASSOC);

        if(isset($data) && $login == $data["user_email"] && $senha == $data["user_senha"]) {
            $_SESSION["user_id"] = $data["user_id"];
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
