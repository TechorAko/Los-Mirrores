<?php
include 'bibliotecas/conecta_mysqli.inc';
$email = $_POST['mailus'];
$senha = $_POST['senhauser'];
$CPF = $_POST['CPFus'];
$rg1 = !empty($_POST['rg1']) ? $_POST['rg1'] : '';
$rg2 = !empty($_POST['rg2']) ? $_POST['rg2'] : '';
$RG = !empty($rg1) && !empty($rg2) ? $rg1 . '-' . $rg2 : '';
$nome = $_POST['nomeus'];
$tel = !empty($_POST['telus']) ? $_POST['telus'] : NULL;
$nasc = !empty($_POST['nasc']) ? $_POST['nasc'] : NULL;
$sexo = !empty($_POST['sexous']) ? $_POST['sexous'] : NULL;
$criacao = $_POST['datetime'];



$sql = "INSERT INTO usuario (Email, Senha, Nome, Sexo, Telefone, CPF, RG, Nascimento, DataCriacao )VALUES('$email', '$senha','$nome', '$sexo', '$tel', '$CPF', '$RG', '$nasc', '$criacao')";
echo "<a href='login.php' ><button>Voltar</button></a>";
if($con -> query($sql) === TRUE){
    echo "Cadastro realizado";
}
    else { echo "Erro: ". $sql . "<br>" . $con->error;}

$con->close();



?>


