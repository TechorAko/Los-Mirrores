<?php

    require_once '../load_admin.php';

    if(isset($_POST["funcionario"])) {
        $ecommerce->inserir("funcionario", $_POST["funcionario"]);
        header("Location: ". $_SERVER['PHP_SELF']);
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Funcionários - Los Mirrores</title>
    </head>
    <body>
        <a href="./">Voltar</a>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <br>Usuário: <select name="funcionario[user_id]">
                <?php
                    $users = $ecommerce->buscar("usuario", "user_id, user_nome");
                    foreach($users as $user) {
                        ?><option value="<?=$user["user_id"]?>"><?=$user["user_nome"]?></option><?php
                    }
                ?>
            </select>
            <br>Salário: <input type="number" name="funcionario[func_salario]" step="0.01" min="0.01" max="999999" placeholder="0.00" required>
            <br>Cargo: <select name="funcionario[func_cargo]">
                <?php
                    $cargos = ["Gerente", "Administrador", "RH", "Vendedor"];
                    foreach($cargos as $cargo) {
                        ?><option value="<?=$cargo?>"><?=$cargo?></option><?php
                    }
                ?>
            </select>
            <br>Data de Admissão: <input type="date" name="funcionario[func_admissao]">
            <br>
            <br><input type="submit" value="Criar Funcionário">
        </form>
        <br>
        <table border=1>
                <tr>
                    <th>ID</th>
                    <th>Usuário</th>
                    <th>Cargo</th>
                    <th>Salário</th>
                    <th>Data de Admissão</th>
                </tr>
                <?php
                    $funcionarios = $ecommerce->buscar("funcionario, usuario", "func_id, user_nome, func_cargo, func_salario, func_admissao", ["funcionario.user_id" => "usuario.user_id"]);
                    if(is_array($funcionarios)) { foreach($funcionarios as $funcionario) {
                        ?>
                            <tr>
                                <?php
                                    if(is_array($funcionario)) { foreach($funcionario as $valores) {
                                        ?><td><?=$valores?></td><?php
                                    } }
                                ?>
                            </tr>
                        <?php
                    } }

                ?>
        </table>
    </body>
</html>