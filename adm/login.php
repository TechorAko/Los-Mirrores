<?php

    require_once 'load_admin.php';

    session_start();

    if(isset($_REQUEST["sair"])) {
        session_unset();
        session_destroy();
        header('Location: '. 'login.php');
        die();
    }

    if(isset($_POST["login"])) {

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

    if(isset($_SESSION["user_id"])) { header('Location: '. 'index.php'); die(); }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Entrar - Los Mirrores</title>
    </head>
    <body>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <br>Olá, Administrador. Por favor, entre com sua conta.
            <br>
            <br>Email: <input type="email" name="login">
            <br>Senha: <input type="password" name="senha">
            <br>
            <br><input type="submit" value="Entrar">
        </form>
    </body>
</html>