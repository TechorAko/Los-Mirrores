<?php

include "biblioteca/mysql.lib";

$valores = ["a", "b", "c", "2020-02-02"];
print_r($ecommerce->descrever("usuario"));
echo "<hr>";
//$ecommerce->cadastrar("usuario", "Email, Senha, Nome, Nascimento", $valores);
$ecommerce->buscar("usuario", ["*"], "Email", "a");
die();

session_start();

if (isset($_POST['logar'])) {

    $login = $_POST['login'];
    $senha = $_POST['password'];

    $tabela = "usuario";
    $atributos = "ID, Email, Senha";
    $referencia = "Email";
    $pesquisa = $login;

    $busca = buscar($tabela, $atributos, $referencia, $pesquisa);

    if($login == $busca[1] AND $senha == $busca[2]) {
        $_SESSION['usuario'] = $busca[0];
    }

}

if (isset($_SESSION['usuario'])) {header('Location: '.'index.php'); die();}

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
            <br>Senha: <input type="password" name="password" placeholder="Insira sua senha aqui">
            <br>
            <br><input type="submit" name="logar" value="Logar"><br>
        </form>
    </body>
</html>

