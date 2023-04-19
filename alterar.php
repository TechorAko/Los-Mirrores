<?php

    include "bibliotecas/conecta_mysqli.inc";
    include "bibliotecas/ver_session.inc";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Alterar</title>
	<style>
		.popup {
			display: none;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			width: 300%;
			height: 200%;
			background-color: #fff;
			border: 1px solid #ccc;
			padding: 20px;
			box-sizing: border-box;
		}
		.close {
			position: absolute;
			top: 10px;
			right: 10px;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<button id="btn">Alterar</button>

	<div class="popup">
		<button class="close">X</button>
		<form method="POST" action="<?=$_SERVER['PHP_SELF']?>">
            <?php 
           
            if(isset($_POST['envio'])){
                include "bibliotecas/conecta_mysqli.inc";
include "bibliotecas/ver_session.inc";
                  $mail = $_POST['mail'];
                $nome ='';
                $date = '';
                $passw = '';
            }
            $sql = "SELECT * FROM usuario WHERE email='$mail'";
            $select = $con -> query($sql);
            if($select){
                while($linha = mysqli_fetch_array($select)){
                    $cod = $linha['ID'];
                    $nome = $linha['nome'];
                    $date = $linha['data_nasc'];
            $email = $linha['email'];
            $passw = $linha['passwor'];
         
            
            
                }
            }
            else{  echo "Erro: ". $sql . "<br>" . $con->error; echo "<a href=../home.html>Voltar</a>";}
            ?>
    <fieldset>
<legend> Dados de Login </legend>
E-mail:<br> <input type="mail" maxlength="30" placeholder="Digite seu e-mail" name="mailus" required>
<br>
Senha:<br> <input type="password" placeholder="Digite sua senha" name="senhauser" required>
<input type="hidden" name="datetime"  value="<?=date("Y-m-d h:i:s")?>"></input>
</fieldset>
        <fieldset>
            <legend>Dados Pessoais</legend>
        CPF:<br> <input oninput="mascaraCPF(this)" type="text" name="CPFus" placeholder="Digite seu CPF">
      <br><br>
      RG:  <br><select name="rg1">
                            <?php
                                $uf = ["AC","AL","AP","AM","BA","CE","ES","GO","MA","MT","MS","MG","PA","PB","PR","PE","PI","RJ","RN","RS","RO","RR","SC","SP","SE","TO"];
                                foreach($uf as $sigla) {
                                    ?><option value="<?=$sigla?>"><?=$sigla?></option><?php
                                } 
                            ?>
                             </select> - <input type="text" name="rg2" maxlength="9" size="6" placeholder="12.345.678">
                            <br><br>
            Nome:<br> <input type="text" placeholder="Digite seu nome" maxlength="50" name="nomeus" required>

           <br><br>
                Telefone:<br> <input type="tel" maxlength="15" placeholder="Digite seu telefone"name="telus">

  
                <br><br>
                Data Nascimento: <br><input type="date" name="nasc"> <br>
Sexo:<br> 
    <input type="radio" name="sexous" value="M">
    <label for="M">Masculino</label>
    <input type="radio" name="sexous" value="F">
    <label for="F">Feminino</label>
     </fieldset>
     <fieldset>
        <legend>Dados para Entrega</legend>
        
     </fieldset>
     <input type="submit"></input>
    </form>
        
	</div>

	<script>
		var btn = document.getElementById("btn");
		var popup = document.querySelector(".popup");
		var close = popup.querySelector(".close");

		btn.addEventListener("click", function() {
			popup.style.display = "block";
		});

		close.addEventListener("click", function() {
			popup.style.display = "none";
		});
	</script>
</body>
</html>
