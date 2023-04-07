<?php 
include '../conecta_mysql.inc';
$nome = $_POST['nome'];
$mail = $_POST['mail'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$coment = $_POST['coments'];
$cpf = $_POST['cpf'];
$erro = 0;

$sql = "INSERT INTO cadusu VALUES ('$nome', '$cpf','$mail', '$cidade', '$estado', '$coment' )";
echo "<a href='../home.html' ><button>Voltar</button></a>";
if($conexao -> query($sql) === TRUE){
    echo "Cadastro realizado";
}
    else { echo "Erro: ". $sql . "<br>" . $conexao->error;}

$conexao->close();


?>