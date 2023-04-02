<html>
    <title>Cadastre-se!</title>
    <meta charset="UTF-8">
<head>
</head>
<body>
    <div> 
        <form  method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Dados Pessoais</legend>
        CPF:<br> <input oninput="mascara(this)" type="text" name="CPFus" placeholder="Digite seu CPF">
      <br><br>
            Nome:<br> <input type="text" placeholder="Digite seu nome" maxlength="50" name="nomeus">

           <br><br>
                Telefone:<br> <input type="tel" maxlength="15" placeholder="Digite seu telefone" onkeyup="handlePhone(event)" name="telus">
                <br><br>
           
               
                Email: <br><input type="mail" maxlength="30" placeholder="Digite seu e-mail" name="mailus">
                <br><br>
                Data Nascimento: <br><input type="date"> <br><br>
                Estado Civil:<br> <div style="float: left;
  width: 12%;">
  <input type="radio" id="Solteiro" name="estcivil" value="Solteiro">
  <label for="Solteiro">Solteiro</label><br>
  <input type="radio" id="Viúvo" name="estcivil" value="Viuvo">
  <label for="Viúvo">Viúvo</label>
</div>

<div tyle="float: left; width: 12%;">
  <input type="radio" id="Casado" name="estcivil" value="Casado">
  <label for="Casado">Casado</label><br>
  <input type="radio" id="Divorciado" name="estcivil" value="Divorciado">
  <label for="Divorciado">Divorciado</label>
</div>
<br><br>
Sexo:<br> 
    <input type="radio" name="sexous" value="M">
    <label for="M">Masculino</label>
    <input type="radio" name="sexous" value="F">
    <label for="F">Feminino</label>
     </fieldset>
     <fieldset>
        <legend>Dados para Entrega</legend>
        
     </fieldset>
    </form>
    </div>
</body>

<script>
function mascara(i){
   
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
</script>
</html>