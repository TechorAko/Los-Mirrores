<?php

require_once "../bibliotecas/mysqli.bli";
require_once "../bibliotecas/conecta_mysqli.inc";
require_once "../bibliotecas/ver_session.inc";

if(isset($_POST["enviar"])) {
    $tabela = "usuario";
    $valores = [
        "Nome" => $_POST["nome"],
        "Email" => $_POST["telefone"],
        "Senha" => $_POST["senha"],
        "Telefone" => $_POST["nascimento"], 
        "Sexo" => $_POST["sexo"],
        "CPF" => $_POST["cpf"],
        "RG" => $_POST["rg1"]."-".$_POST["rg2"],
        "Nascimento" => $_POST["nascimento"],    
        "DataCriacao" => $_POST["datacriacao"],  
      
    ];
    if($ecommerce->inserir($tabela, $valores)) {
        echo "Funcionou";
    } else { echo "Não funcionou"; }
}

?>

<html>
    <head>
        <title>Área Administrativa</title>
        <link rel="stylesheet" href="../style.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Avalição</h1>
        <hr>
        <form action="usuario.php" method="POST">
           
        
        <legend><h2>Usuário</h2></legend>
        <label>Email: </label> <input type="email" name="Email" placeholder="Insira aqui um novo email" maxlength="320" size="25" required><br>
        <label>Senha: </label> <input type="password" name="senha" placeholder="Digite a senha" maxlength="20" minlength="8" size="8" required><br>
        <br>
        <fieldset>
            <legend>Informações</legend>
                <label>Nome:                </label> <input type="text" name="nome" placeholder="Digite o seu nome" maxlength="100" size="25" required>
            <br><label>Telefone:            </label> <input type="tel" name="telefone" maxlength="15" placeholder="(00) 0000-000"> <!-- onkeyup="handlePhone(event)" -->
            <br><label>Sexo:                </label> <input type="radio" name="sexo" value="M">Masculino <input type="radio" name="Sexo" value="F"> Feminino <input type="radio" name="Sexo" value="I"> Intersexo
            <br><label>Data de Nascimento:  </label> <input type="date" name="nascimento" min="19<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" max="20<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" required>
            <br><label>CPF:                 </label> <input type="text" name="cpf" placeholder="Digite seu CPF"> <!-- oninput="mascaraCPF(this)" -->
            <br><label>RG:                  </label> <select name="rg1">
                <?php
                    $uf = ["AC","AL","AP","AM","BA","CE","ES","GO","MA","MT","MS","MG","PA","PB","PR","PE","PI","RJ","RN","RS","RO","RR","SC","SP","SE","TO"];
                    foreach($uf as $sigla) { ?><option value="<?=$sigla?>"><?=$sigla?></option><?php } 
                ?>
            </select> - <input type="text" name="rg2" maxlength="9" size="6" placeholder="12.345.678"> <!-- oninput="MascaraRG(event)" -->
            <input type="hidden" name="datacriacao" value="<?=date("Y-m-d h:i:s")?>">
        </fieldset>
    
            <br><input type="submit" name="enviar" value="Enviar">
        </form>
        <br><a href="../">Voltar</a>
    </body>
</html>