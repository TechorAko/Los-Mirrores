<?php

include "biblioteca/mysql.lib";

if (!isset($_GET['table'])) {header('Location: '.'cadastro.php?table=usuario'); die();}
else {$table = $_GET['table'];}
$table = $_GET['table'];

if(isset($_POST["usuario"])) {

    $atributos = [];
    $valores = [];

    foreach($ecommerce->descrever("usuario") as $atributo) {
        if(isset($_POST[$atributo])) {
            array_push($atributos, $atributo);
            array_push($valores, $_POST[$atributo]);
        }
    }

    if(isset($_POST["rg2"])) {
        $RG = $_POST["rg1"]."-".$_POST["rg2"];
        array_push($atributos, "RG");
        array_push($valores, $RG);
    }

    function convert_array_attributes($array) {
        $conversao = NULL; $i = 0;
        foreach($array as $value) {
            if($i == count($array)-1) {break;}
            $conversao .= $value .",";
            $i++;
        }
        $conversao .= end($array);
        return $conversao;
    }

    $atributos = convert_array_attributes($atributos);
    $ecommerce->cadastrar("usuario",$atributos,$valores);

    
}

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
        <form action="cadastro.php?table=<?=$table?>" method="POST">
            <fieldset>
            <?php
                switch($table) {
                    case "usuario": ?>
                <legend><h1>Usuário</h1></legend>
                    <label>Email:</label> <input type="email" name="Email" placeholder="Insira aqui um novo email" maxlength="320" size="25" required><br>
                    <label>Senha:</label> <input type="password" name="Senha" placeholder="Digite a senha" maxlength="20" size="8" required><br>
                    <br>
                    <fieldset>
                        <legend>Informações</legend>
                            <label>Nome: </label>               <input type="text" name="Nome" placeholder="Digite o seu nome" maxlength="100" size="25" required>
                        <br><label>Telefone: </label>           <input type="tel" name="Telefone" placeholder="+55 (32) 12345-6789" maxlength="19" size="19" pattern="+[0-9]{2} ([0-9]){2} [0-9]{5}-[0-9]{4}">
                        <br><label>Sexo: </label>               <input type="radio" name="Sexo" value="M">Masculino <input type="radio" name="sexo" value="F"> Feminino
                        <br><label>Data de Nascimento: </label> <input type="date" name="Nascimento" min="19<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" max="20<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" required>
                        <br><label>CPF:</label>                 <input type="text" name="CPF" maxlength="14" size="10" placeholder="123.456.789-10" pattern="[0-9]{3}.([0-9]){3}.[0-9]{3}-[0-9]{2}">
                        <br><label>RG:</label>                  <select name="rg1">
                            <?php
                                $uf = ["AC","AL","AP","AM","BA","CE","ES","GO","MA","MT","MS","MG","PA","PB","PR","PE","PI","RJ","RN","RS","RO","RR","SC","SP","SE","TO"];
                                foreach($uf as $sigla) {
                                    ?><option value="<?=$sigla?>"><?=$sigla?></option><?php
                                } 
                            ?>
                        </select> - <input type="text" name="rg2" maxlength="14" size="6" placeholder="12.345.678" pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}">
                        <input type="hidden" name="DataCricao" value="<?=date("Y-m-d h:i:s")?>">
                    </fieldset>
                    <br><input type="submit" name="usuario" value="Cadastrar"> <input type="reset" value="Limpar">
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
        <form action="cadastro.php" method="GET">
            <select name="table"> <?php
                foreach($ecommerce->tabelas as $tabelas) { ?><option value="<?=$tabelas?>" <?php if($table == $tabelas) { echo "selected";} ?>><?=$tabelas?></option><?php } ?>
            </select>
            <input type="submit" value="Trocar">
        </form>
    </body>
</html>