<?php
session_start();
require_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/bli/load_front";
$msg = "";
if (isset($_POST['logar'])) {
    $email = $_POST['emaill'];
    $senha = $_POST['senhal'];
    $logar = $ecommerce->buscar("usuario", "user_id", ["user_email" => $email, "user_senha" => $senha]);
    if (!empty($logar)) {
        $_SESSION["user_id"] = $logar[0]["user_id"];
        header('Location: index.php');
        die();
    } else {
      header('Location: login.php?erro');
  
    }
}


if(isset($_POST["usuario"])) {
  if(isset($_FILES["pfp"]) && !empty(basename($_FILES['pfp']['name']))) {
      $endereco = "assets/media/pfp/";
      $target_path = $endereco . basename($_FILES['pfp']['name']);
      $novoNome = rand(0,10000000000000) . substr(basename($_FILES['pfp']['name']), -4);
      
      if(!move_uploaded_file($_FILES['pfp']['tmp_name'], $endereco.$novoNome)) { echo "<br>A imagem não foi enviada."; }

      $_POST["usuario"]["user_pfp"] = "http://". $_SERVER["SERVER_NAME"] ."/Los-Mirrores/assets/media/pfp/".$novoNome;
  }
  $ecommerce->inserir("usuario", $_POST["usuario"]);

  
}

?>

<!DOCTYPE html>
<html lang="en">
	<head> 
		<link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
        <title>Electro - HTML Ecommerce Template</title>
        <?php include_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/bli/bootstrap/"; ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>




    </head>
	<body>
  <div class=" pt-1">
    <div class="container">
    <picture class="d-flex align-items-center justify-content-center h-100">
                <img src="http://<?=$_SERVER['SERVER_NAME']?>/Los-Mirrores/assets/media/losmirrores_logo.png" alt="Logo Icon" class="d-none d-md-block pt-4" style="width:20vw;" />
            </picture>
        <div class="row justify-content-center">
     

            <div class="section pb-5 pt-5 pt-sm-2 text-center pb-5">
                <h6 class="mb-0 pb-3"><span>Entrar </span><span>Criar Conta</span></h6>
                <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                <label for="reg-log"></label>
                <div class="card-3d-wrap mx-auto mt-1">
                    <div class="card-3d-wrapper">
                        <div class="card-front">
                            <div class="center-wrap">
                                <p><?php if (isset($_GET['erro'])) { echo "Usuário ou senha inválido"; } ?></p>
                                <div class="section text-center">
                                    <h4 class="mb-4 pb-3">Entrar</h4>
                                    <form action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
                                        <div class="form-group">
                                            <input type="email" class="form-style" placeholder="Email" name="emaill">
                                            <i class="input-icon uil uil-at"></i>
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="password" class="form-style" placeholder="Password" name="senhal">
                                            <i class="input-icon uil uil-lock-alt"></i>
                                        </div>
                                        <button type="submit" name="logar" class="btn mt-4">Login</button>
                                        <p class="mb-0 mt-4 text-center"><a href="https://www.youtube.com/watch?v=0Uuk_DkpiB0&ab_channel=FrasesMarcantes" class="link">Esqueceu sua senha?</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-back">
                            <div class="center-wrap">
                                <div class="text-center">
                                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <h4 class="mb-3 pb-3">Criar Conta</h4>
    <div class="form-group mt-2">
        <input type="file" class="form-style-2"  name="pfp" accept="image/*" required>
    </div>

    <div class="form-group mt-2">
        <input type="text" class="form-style-2" placeholder="Nome completo" name="usuario[user_nome]" required>
        <i class="input-icon-2 uil uil-user"></i>
    </div>
    <div class="form-group mt-2">
        <input type="email" class="form-style-2" placeholder="Email" name="usuario[user_email]" required>
        <i class="input-icon-2 uil uil-at"></i>
    </div>
    <div class="form-group mt-2">
        <input type="tel" class="form-style-2" placeholder="Telefone" name="usuario[user_telefone]">
        <i class="input-icon-2 uil uil-phone"></i>
    </div>
    <div class="form-group mt-2">
        <input type="password" class="form-style-2" placeholder="Senha" name="usuario[user_senha]" required>
        <i class="input-icon-2 uil uil-lock-alt"></i>
    </div>
    <div class="form-group mt-2">
    <input type="text" class="form-style-2 cpf-mask pr-4" id="cpf" name="usuario[user_cpf]" required placeholder="000.000.000">
    <i class="input-icon-2"for="cpf" style="font-size: 1vw;">CPF</i>
</div>
<div class="form-group mt-2">
   
    <input type="text" id="rg" name="usuario[user_rg]" class="form-style-2" placeholder="MG-00.000.000">
    <i for="rg" class="input-icon-2 pr-1" style="font-size: 1vw;">RG</i>
</div>

    <div class="form-group mt-2">
        <input type="date" class="form-style-2" placeholder="Data de Nascimento" name="usuario[user_nascimento]" required>
        <i class="input-icon-2 uil uil-calendar-alt"></i>
    </div>
    <div class="form-group mt-2">
        <select class="form-style-2" name="gender">
            <option value="">Selecione o sexo</option>
            <option name="usuario[user_sexo]" value="M">Masculino</option>
            <option name="usuario[user_sexo]" value="F">Feminino</option>
            <option  name="usuario[user_sexo]" value="I">Intersexo</option>
        </select>
        <i class="input-icon-2 uil uil-venus-mars"></i>
    </div>
    


    <button type="submit" class="btn mt-4" name="register">Registrar</button>
</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>


<script>
$(document).ready(function() {
  $('.cpf-mask').inputmask('999.999.999-99');
  $('#rg').inputmask('AA-99.999.999', {
  
    clearMaskOnLostFocus: false
  });
});
</script>

  <script>
  $('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
  var $this = $(this),
	  label = $this.prev('label');

	  if (e.type === 'keyup') {
			if ($this.val() === '') {
		  label.removeClass('active highlight');
		} else {
		  label.addClass('active highlight');
		}
	} else if (e.type === 'blur') {
		if( $this.val() === '' ) {
			label.removeClass('active highlight'); 
			} else {
			label.removeClass('highlight');   
			}   
	} else if (e.type === 'focus') {
	  
	  if( $this.val() === '' ) {
			label.removeClass('highlight'); 
			} 
	  else if( $this.val() !== '' ) {
			label.addClass('highlight');
			}
	}

});

$('.tab a').on('click', function (e) {
  
  e.preventDefault();
  
  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');
  
  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});

</script>
<style>
			@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900');
body{
	font-family: 'Poppins', sans-serif;
	font-weight: 300;
	line-height: 1.7;
	color: #ffeba7;
	background-color: #1f2029;

}
span{
color:  #ffeba7;}
a:hover {
	text-decoration: none;
}
.link {
  color: #ffeba7;
}
.link:hover {
  color: #c4c3ca;
}
p {
  font-weight: 500;
  font-size: 14px;
}
h4 {
  font-weight: 600;
  color: white; 
}
h6 span{
  padding: 0 20px;
  font-weight: 700;
}
.section{
  position: relative;
  width: 100%;

}
.full-height{
  min-height: 100vh;
}
[type="checkbox"]:checked,
[type="checkbox"]:not(:checked){
display: none;
}
.checkbox:checked + label,
.checkbox:not(:checked) + label{
  position: relative;
  display: block;
  text-align: center;
  width: 60px;
  height: 16px;
  border-radius: 8px;
  padding: 0;
  margin: 10px auto;
  cursor: pointer;
  background-color: #ffeba7;
}
.checkbox:checked + label:before,
.checkbox:not(:checked) + label:before{
  position: absolute;
  display: block;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  color: #ffeba7;
  background-color: #020305;
  font-family: 'unicons';
  content: '\eb4f';
  z-index: 20;
  top: -10px;
  left: -10px;
  line-height: 36px;
  text-align: center;
  font-size: 24px;
  transition: all 0.5s ease;
}
.checkbox:checked + label:before {
  transform: translateX(44px) rotate(-270deg);
}
.card-3d-wrap {
  position: relative;
  width: 440px;
  max-width: 100%;
  height: 500px;
  -webkit-transform-style: preserve-3d;
  transform-style: preserve-3d;
  perspective: 800px;
  margin-top: 60px;
}.card-3d-wrap-2 {
  position: relative;
  width: 440px;
  max-width: 100%;
  height: 500px;
  -webkit-transform-style: preserve-3d;
  transform-style: preserve-3d;
  perspective: 800px;
  margin-top: 60px;
}
.card-3d-wrapper {
  width: 100%;
  height: 100%;
  position:absolute;
  -webkit-transform-style: preserve-3d;
  transform-style: preserve-3d;
  transition: all 600ms ease-out; 
}
.card-front, .card-back {
  width: 100%;
  height: 100%;
  background-color: #2b2e38;
  background-image: url('/img/subtle-prism.png');
  position: absolute;
  border-radius: 6px;
  -webkit-transform-style: preserve-3d;
}
.card-back {
  transform: rotateY(180deg);
}
.checkbox:checked ~ .card-3d-wrap .card-3d-wrapper {
  transform: rotateY(180deg);
}
.center-wrap{
  position: absolute;
  width: 100%;
  padding: 0 35px;
  top: 50%;
  left: 0;
  transform: translate3d(0, -50%, 35px) perspective(100px);
  z-index: 20;
  display: block;
}
.form-group{ 
  position: relative;
  display: block;
    margin: 0;
    padding: 0;
}
.form-style {
  padding: 13px 20px;
  padding-left: 55px;
  height: 48px;
  width: 100%;
  font-weight: 500;
  border-radius: 4px;
  font-size: 14px;
  line-height: 22px;
  letter-spacing: 0.5px;
  outline: none;
  color: #c4c3ca;
  background-color: #1f2029;
  border: none;
  -webkit-transition: all 200ms linear;
  transition: all 200ms linear;
  box-shadow: 0 4px 8px 0 rgba(21,21,21,.2);
}
.form-style:focus,
.form-style:active {
  border: none;
  outline: none;
  box-shadow: 0 4px 8px 0 rgba(21,21,21,.2);
}
.form-style-2 {
  padding: 8px 15px;
  padding-left: 40px;
  height: 35px;
  width: 100%;
  font-weight: 500;
  border-radius: 4px;
  font-size: 14px;
  outline: none;
  color: #c4c3ca;
  background-color: #1f2029;
  border: none;
  -webkit-transition: all 200ms linear;
}
.form-style-2:focus,
.form-style-2:active {
  border: none;
  outline: none;
  box-shadow: 0 4px 8px 0 rgba(21,21,21,.2);
}
.input-icon {
  position: absolute;
  top: 0;
  left: 18px;
  height: 48px;
  font-size: 24px;
  line-height: 48px;
  text-align: left;
  -webkit-transition: all 200ms linear;
   transition: all 200ms linear;
}
.input-icon-2 {
  position: absolute;
  top: 10;
  left: 3px;
  height: 45px;
  font-size: 20px;
  line-height: 30px;
  text-align: left;
  -webkit-transition: all 200ms linear;
   transition: all 200ms linear;
}
.btn{  
  border-radius: 4px;
  height: 44px;
  font-size: 13px;
  font-weight: 600;
  text-transform: uppercase;
  -webkit-transition : all 200ms linear;
  transition: all 200ms linear;
  padding: 0 30px;
  letter-spacing: 1px;
  display: -webkit-inline-flex;
  display: -ms-inline-flexbox;
  display: inline-flex;
  align-items: center;
  background-color: #ffeba7;
  color: #000000;
}
.btn:hover{  
  background-color: #000000;
  color: #ffeba7;
  box-shadow: 0 8px 24px 0 rgba(16,39,112,.2);
}


		</style>
</html>
