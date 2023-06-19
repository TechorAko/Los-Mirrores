<?php

    require_once 'load_admin.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Administrativa - Los Mirrores</title>
</head>
<body>
    <h1>Área Administrativa</h1>
    <ul>
        <li>Gerenciar</li>
        <br>
        <ul>
            <li><a href="gerenciar/produtos.php">Produtos</a></li>
            <li><a href="gerenciar/pedidos.php">Pedidos</a></li>
            <li><a href="gerenciar/funcionarios.php">Funcionários</a></li>
            <li><a href="gerenciar/usuarios.php">Usuários</a></li>
        </ul>
        <br>
        <li>Relatórios</li>
        <br>
        <ul>
            <li><a href="relatorios/">Relatórios</a></li>
        </ul>
    </ul>
</body>
</html>