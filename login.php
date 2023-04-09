<?php

    session_start();
    include "bibliotecas/conecta_mysqli.inc";

    if(isset($_GET["sair"])) {
        session_unset();
        session_destroy();
        header('Location: '. 'login.php');
        die();
    }

    if(isset($_POST["enviar"])) {

        $login = $_POST["login"];
        $senha = $_POST["senha"];

        $sql = "SELECT ID, Email, Senha FROM usuario WHERE Email = '$login'";
        $select = $con->query($sql);
        if ($select) {
            if($linha = mysqli_fetch_array($select)) {
                $user_id     = $linha['ID'];
                $user_email  = $linha['Email'];
                $user_senha  = $linha['Senha'];
            }
        } else { echo "Erro: " . $sql . "<br>" . $con->error; }

        if($login == $user_email && $senha == $user_senha) {
            $_SESSION["user_id"] = $user_id;
            header('Location: '. 'index.php');
            die();
        } else { echo "Erro: Usuário inválido."; }
    }

    if(isset($_SESSION["user_id"])) { header('Location: '. 'index.php'); die(); }

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
