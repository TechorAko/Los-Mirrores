<?php 
include 'conecta_mysql.inc';

$email = $_POST["email"];

$sql = "DELETE FROM cadastro WHERE email ='$email'";
if($conexao->query($sql) === TRUE){
    echo "Usuário excluído com sucesso!<br>";
    echo "<a href=index.html>Voltar</a>";
}
else{
    echo "Erro: ". $sql. "<br>". $conexao->error;
    echo "<a href=index.html>Voltar</a>";
}
$conexao->close();
?>