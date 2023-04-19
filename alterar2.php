<?php

include "bibliotecas/conecta_mysqli.inc";
include "bibliotecas/ver_session.inc";

$data = unserialize($_COOKIE["alterar"]);
if(isset($data["RG"]) && $data["RG"] != NULL) { $RG = explode("-", $data["RG"]); }

function checked($entry, $value, $select = FALSE) {
    if($entry == $value) {
        if ($select == TRUE) { $response = "selected"; } else { $response = "checked"; }
        return $response;
    }
    else { return ""; }
}

?>

<html> 
    <head>
        <meta charset="utf-8">
        <title>Alteração de cadastro</title>
    </head>
    <body>
        <form method="POST" action="alterar2.php">
            <label>Email:</label> <input type="email" name="Email" placeholder="Insira aqui um novo email" maxlength="320" size="25" required value="<?=$data["Email"]?>"><br>
            <label>Senha:</label> <input type="password" name="Senha" placeholder="Digite a senha" maxlength="20" minlength="8" size="8" required value="<?=$data["Senha"]?>"><br>
            <br>
                <fieldset>
                    <legend>Informações</legend>
                                <label>Nome:                </label> <input type="text" name="Nome" placeholder="Digite o seu nome" maxlength="100" size="25" required value="<?=$data["Nome"]?>">
                            <br><label>Telefone:            </label> <input type="tel" name="Telefone" maxlength="15" placeholder="(00) 0000-000" value="<?=$data["Telefone"]?>"> <!-- onkeyup="handlePhone(event)" -->
                            <br><label>Sexo:                </label> <input type="radio" name="Sexo" value="M" <?=checked($data["Sexo"], "M")?>>Masculino <input type="radio" name="Sexo" value="F" <?=checked($data["Sexo"], "F")?>> Feminino <input type="radio" name="Sexo" value="I" <?=checked($data["Sexo"], "I")?>> Intersexo
                            <br><label>Data de Nascimento:  </label> <input type="date" name="Nascimento" min="19<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" max="20<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" value="<?=$data["Nascimento"]?>" required>
                            <br><label>CPF:                 </label> <input type="text" name="CPF" placeholder="Digite seu CPF" value="<?=$data["CPF"]?>"> <!-- oninput="mascaraCPF(this)" -->
                            <br><label>RG:                  </label> <select name="rg1">
                                <?php
                                    $uf = ["AC","AL","AP","AM","BA","CE","ES","GO","MA","MT","MS","MG","PA","PB","PR","PE","PI","RJ","RN","RS","RO","RR","SC","SP","SE","TO"];
                                    foreach($uf as $sigla) { ?><option value="<?=$sigla?>" <?=checked($RG[0], $sigla, TRUE);?>><?=$sigla?></option><?php } 
                                ?>
                            </select> - <input type="text" name="rg2" maxlength="9" size="6" placeholder="12.345.678" value="<?=$RG[1]?>"> <!-- oninput="MascaraRG(event)" -->
                            <input type="hidden" name="DataCriacao" value="<?=date("Y-m-d h:i:s")?>">
                </fieldset>
        </form>
    </body>
</html>