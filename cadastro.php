<?php

include "bibliotecas/conecta_mysqli.inc";
include "bibliotecas/ver_session.inc";

if(isset($_GET["table"])) { $table = $_GET["table"]; } else { header('Location: '. $_SERVER['PHP_SELF'] .'?table='. $ecommerce->tabelas[0]); die(); }
if(isset($_POST["enviar"])) {

    // Processo de recepção de dados para serem inseridos.

    $atributos = $ecommerce->descrever($table); // Resgata todos os atributos disponíveis na tabela selecionada.
    if(isset($_POST["rg2"])) { $RG = $_POST["rg1"]."-".$_POST["rg2"]; } // Está mesclando a sigla e os números do RG.

    foreach ($atributos as $atributo) { // Para cada atributo será preenchido com os dados recebidos
        if($atributo == "RG" && isset($RG)) { $data["RG"] = $RG; } // O caso especial do RG.
        if(isset($_POST[$atributo])) { $data["$atributo"] = $_POST[$atributo]; } // Se o atributo existe, ele será enviado.
    }

    $ecommerce->inserir($table, $data);
}

?>

<html>
    <head>
        <title>Cadastro</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <style>
            fieldset { text-align: left; }
        </style>
    </head>
    <body>
        <h1>Área Administrativa</h1>
        <hr><br>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
            <select name="table"> <?php
                foreach($ecommerce->tabelas as $tabelas) { ?><option value="<?=$tabelas?>" <?php if($table == $tabelas) { echo "selected";} ?>><?=$tabelas?></option><?php } ?>
            </select>
            <input type="submit" value="Trocar">
        </form>
        <form action="<?=$_SERVER['PHP_SELF'] . "?table=$table"?>" method="POST">
            <fieldset>
                <?php
                    switch($table) {
                        case "usuario":
                            ?>
                                <legend><h2>Usuário</h2></legend>
                                <label>Email:</label> <input type="email" name="Email" placeholder="Insira aqui um novo email" maxlength="320" size="25" required><br>
                                <label>Senha:</label> <input type="password" name="Senha" placeholder="Digite a senha" maxlength="20" minlength="8" size="8" required><br>
                                <br>
                                <fieldset>
                                    <legend>Informações</legend>
                                        <label>Nome:                </label> <input type="text" name="Nome" placeholder="Digite o seu nome" maxlength="100" size="25" required>
                                    <br><label>Telefone:            </label> <input type="tel" name="Telefone" placeholder="+55 (32) 12345-6789" maxlength="19" size="19" pattern="+[0-9]{2} ([0-9]){2} [0-9]{5}-[0-9]{4}">
                                    <br><label>Sexo:                </label> <input type="radio" name="Sexo" value="M">Masculino <input type="radio" name="Sexo" value="F"> Feminino
                                    <br><label>Data de Nascimento:  </label> <input type="date" name="Nascimento" min="19<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" max="20<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" required>
                                    <br><label>CPF:                 </label> <input type="text" name="CPF" maxlength="14" size="10" placeholder="123.456.789-10" pattern="[0-9]{3}.([0-9]){3}.[0-9]{3}-[0-9]{2}">
                                    <br><label>RG:                  </label> <select name="rg1">
                                        <?php
                                            $uf = ["AC","AL","AP","AM","BA","CE","ES","GO","MA","MT","MS","MG","PA","PB","PR","PE","PI","RJ","RN","RS","RO","RR","SC","SP","SE","TO"];
                                            foreach($uf as $sigla) { ?><option value="<?=$sigla?>"><?=$sigla?></option><?php } 
                                        ?>
                                    </select> - <input type="text" name="rg2" maxlength="10" size="6" placeholder="12.345.678" pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}">
                                    <input type="hidden" name="DataCriacao" value="<?=date("Y-m-d h:i:s")?>">
                                </fieldset>
                            <?php
                            break;
                        case "categoria":
                            ?>
                                <legend><h2>Categoria</h2></legend>
                                <label> Nome: </label><input type="text" name="Nome" placeholder="Digite o nome da categoria" maxlength="20" size="20" required>
                                <br><label> Descrição: </label>
                                <br><textarea cols=100 rows=5 placeholder="Descreva esta categoria, caso necessário, se, por exemplo, a categoria for muito específica."></textarea><br>
                            <?php
                            break;
                        case "produto":
                            ?>
                                <legend><h2>Produto</h2></legend>
                            <?php
                            break;
                        case "funcionario":
                            ?>
                                <legend><h1>Funcionário</h1></legend>
                                <label>Cargo: </label>
                                <select name="Cargo">
                                    <option value="Gerente">Gerente</option>
                                    <option value="RH">RH</option>
                                    <option value="Mercadologo">Mercadólogo</option>
                                    <option value="Vendedor">Vendedor</option>
                                </select>
                                <br><label>Salário: </label><input type="number" name="Salario" step="0.01" placeholder="1000.00" min="0" max="9999999" required>
                                <br><label>Usuário: </label>
                                <select name="user_id">
                                    <?php
                                        $usuarios = $ecommerce->exibir("usuario");
                                        foreach ($usuarios as $index => $usuario) { ?><option value="<?=$usuario["ID"]?>"><?=$usuario["Nome"]?></option><?php }
                                    ?>
                                </select>
                                <br><label>Data de Admissão: </label><input type="date" name="Admissao" min="19<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" max="20<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" required>
                                <br>
                            <?php
                        default: $table = "produto";
                    }
                ?>
                <br><input type="submit" name="enviar" value="Cadastrar"> <input type="reset" value="Limpar">
            </fieldset>
        </form>

        <a href="./">Voltar</a>
    </body>
</html>