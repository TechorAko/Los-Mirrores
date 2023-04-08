<?php

session_start();
if(!isset($_SESSION["user_id"])) { header('Location: '.'login.php'); die(); }
else {
    // Validação de usuário registrado.

    $tabela = "usuario"; $atributos = ["ID"]; $referencia = "ID"; $pesquisa = $_SESSION["user_id"];
    $resultado = $ecommerce->buscar($tabela, $atributos, $referencia, $pesquisa); // Irá efetuar a pesquisa e ver se o resultado bate.

    if(is_string($resultado) == 1) { echo "Erro: Usuário inválido. Por favor, faça login novamente.<br><a href='login.php?sair=1'>Voltar</a>"; die(); }
    // Caso o contrário, a sessão será destruída e o usuário deverá logar novamente.
}

?>