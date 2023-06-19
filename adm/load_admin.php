<?php

    if(!str_contains($_SERVER["SERVER_NAME"], "localhost")) { $path = "http://". $_SERVER["SERVER_NAME"]; } else { $path = "http://". $_SERVER["SERVER_NAME"] ."/TechorAko/Los-Mirrores"; }

    require_once "$path/bibliotecas/mysqli.bli";
    require_once "$path/bibliotecas/conecta_mysqli.inc";

    if(!str_contains($_SERVER["PHP_SELF"], "login.php")) {
        session_start();
        if(!isset($_SESSION["user_id"])) { header('Location: '.'login.php'); die(); }
        else {
            // Validação de usuário registrado.

            $sql = "SELECT usuario.user_id, funcionario.user_id, funcionario.func_cargo FROM `usuario`, `funcionario` WHERE usuario.user_id = '". $_SESSION["user_id"] ."' AND usuario.user_id = funcionario.user_id AND funcionario.func_cargo = 'Gerente'";
            $resultado = $con->query($sql); // Irá efetuar a pesquisa e ver se o resultado bate.
            if($resultado->fetch_array(MYSQLI_ASSOC)) { $resultado = TRUE; } else { $resultado = FALSE; }

            if($resultado != TRUE) { die("Erro: Acesso negado, o usuário não tem permissão de acessar esta página.<br><a href='login.php?sair=1'>Voltar</a>"); }
            // Caso o contrário, a sessão será destruída e o usuário deverá logar novamente.
        }
    }

?>