<?php

session_start();
if(!isset($_SESSION["user_id"])) { header('Location: '.'login.php'); die(); }
else {
    // Validação de usuário registrado.

    $sql = "SELECT usuario.ID, funcionario.user_id, funcionario.cargo FROM `usuario`, `funcionario` WHERE usuario.ID = '". $_SESSION["user_id"] ."' AND usuario.ID = funcionario.user_id AND funcionario.cargo = 'Gerente'";
    $resultado = $con->query($sql); // Irá efetuar a pesquisa e ver se o resultado bate.
    if($resultado->fetch_array(MYSQLI_ASSOC)) { $resultado = TRUE; } else { $resultado = FALSE; }

    if($resultado != TRUE) { die("Erro: Acesso negado, o usuário não tem permissão de acessar esta página.<br><a href='login.php?sair=1'>Voltar</a>"); }
    // Caso o contrário, a sessão será destruída e o usuário deverá logar novamente.
}

?>