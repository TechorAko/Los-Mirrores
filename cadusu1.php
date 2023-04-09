
<html>
    <title>Cadastre-se!</title>
    <meta charset="UTF-8">
<head>
</head>
<body>
    <div> 
        <form action="cadusu.php" method="post" enctype="multipart/form-data">
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
                             </select> - <input type="text" name="rg2" maxlength="9" size="6"oninput="MascaraRG(event)" placeholder="12.345.678">
                            <br><br>
            Nome:<br> <input type="text" placeholder="Digite seu nome" maxlength="50" name="nomeus" required>

           <br><br>
                Telefone:<br> <input type="tel" maxlength="15" placeholder="Digite seu telefone" onkeyup="handlePhone(event)" name="telus">

  
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
</body>

<script>
function mascaraCPF(i){
   
    var v = i.value;
    
    if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
       i.value = v.substring(0, v.length-1);
       return;
    }
    
    i.setAttribute("maxlength", "14");
    if (v.length == 3 || v.length == 7) i.value += ".";
    if (v.length == 11) i.value += "-";
 
 }
 const handlePhone = (event) => {
  let input = event.target
  input.value = phoneMask(input.value)
}

const phoneMask = (value) => {
  if (!value) return ""
  value = value.replace(/\D/g,'')
  value = value.replace(/(\d{2})(\d)/,"($1) $2")
  value = value.replace(/(\d)(\d{4})$/,"$1-$2")
  return value
}
function MascaraRG(event) {
  let input = event.target;
  let value = input.value;
  value = value.replace(/\D/g, '');
  value = value.replace(/^(\d{2})(\d{3})(\d{3})$/, '$1.$2.$3');
  input.value = value;
}

</script>
</html>