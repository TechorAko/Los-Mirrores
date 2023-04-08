<?php

include "bibliotecas/conecta_mysqli.inc";

if (!isset($_GET['table'])) {header('Location: '.'geral.php?table=exibir'); die();}
else {$table = $_GET['table'];}
$table = $_GET['table'];

?>
<html>
    <head>
        <title>Cadastro</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <style>
            fieldset {text-align: left;}
        </style>
    </head>
    <body>
        <form action="geral.php?table=<?=$table?>" method="POST">
            <fieldset>
            <?php
                switch($table) {
                    case "usuario": ?>
                <legend><h1>Exibir Usuários</h1></legend>
                <table border=1>
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Senha</th>
        <th>Nome</th>
        <th>Sexo</th>
        <th>Telefone</th>
        <th>CPF</th>
        <th>RG</th>
        <th>Nascimento</th>
        <th>DataCriacao</th>
        <th>Editar/Excluir</th>
    </tr>
    <?php 
    
    $sql = "SELECT ID, Email, Senha, Nome, Sexo, Telefone, CPF, RG, Nascimento, DataCriacao FROM usuario";
    $select = $con->query($sql);
    if ($select) {
        while($linha = mysqli_fetch_array($select)) {
            $ID        = $linha['ID'];
            $Email     = $linha['Email'];
            $Senha      = $linha['Senha'];
            $Nome  = $linha['Nome'];
            $Sexo        = $linha['Sexo'];
            $Telefone      = $linha['Telefone'];
            $CPF     = $linha['CPF'];
            $RG    = $linha['RG'];
            $Nascimento      = $linha['Nascimento'];
            $DataCriacao      = $linha['DataCriacao'];

            echo "<tr>\n
                    <td>$ID</td>\n
                    <td>$Email</td>\n
                    <td>$Senha</td>\n
                    <td>$Nome</td>\n
                    <td>$Sexo</td>\n
                    <td>$Telefone</td>\n
                    <td>$CPF</td>\n
                    <td>$RG</td>\n
                    <td>$Nascimento</td>\n
                    <td>$DataCriacao</td>\n
                    <td>
                        <form method='POST' action='edicao.php'>
                            <input type='submit' name='editmode' value='Alterar'>
                            <input type='submit' name='editmode' value='Eliminar'>
                            <input type='hidden' name='ID' value='$ID'>
                            <input type='hidden' name='Email' value='$Email'>
                            <input type='hidden' name='Senha' value='$Senha'>
                            <input type='hidden' name='Nome' value='$Nome'>
                            <input type='hidden' name='Sexo' value='$Sexo'>
                            <input type='hidden' name='Telefone' value='$Telefone'>
                            <input type='hidden' name='CPF' value='$CPF'>
                            <input type='hidden' name='RG' value='$RG'>
                            <input type='hidden' name='Nascimento' value='$Nascimento'>
                            <input type='hidden' name='DataCriacao' value='$DataCriacao'>
                        </form>
                    </td>
                </tr>\n";
        }
        echo "<a href=../home.html>Voltar</a>";
    } else {
        echo "Erro: " . $sql . "<br>" . $con->error;
        echo "<button><a href=../home.html>Voltar</a></button>";
    }
    ?>
            <?php       break;
                    case "funcionario": ?>
                <legend><h1>Funcionário</h1></legend>
                <label>Data de Admissão: </label> <input type="date" name="admissao" min="19<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" max="20<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" required>
                <br><label>Salário: </label>      <input type="number" name="salario" step="0.01" placeholder="1000.00" min="0" max="9999999" required>
                <br><label>Cargo: </label>
                    <select>
                        <option>Indisponível</option>
                    </select>
            <?php       break;
                    case "cliente": ?>
                <legend><h1>Cliente</h1></legend>
            <?php       break;
                    case "categoria": ?>
                <legend><h1>Categoria</h1></legend>
            <?php       break;
                    case "produto": ?>
                <legend><h1>Produto</h1></legend>
            <?php       break;
                    case "avaliacao": ?>
                <legend><h1>Avaliação</h1></legend>
            <?php       break;
                }
            ?>
            </fieldset>
        </form>
        <br>
        <form action="geral.php" method="GET">
            <select name="table"> <?php
                foreach($ecommerce->tabelas as $tabelas) { ?><option value="<?=$tabelas?>" <?php if($table == $tabelas) { echo "selected";} ?>><?=$tabelas?></option><?php } ?>
            </select>
            <input type="submit" value="Trocar">
        </form>
    </body>
</html>