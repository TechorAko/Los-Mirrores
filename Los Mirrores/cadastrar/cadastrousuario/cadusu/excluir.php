<?php 
include '../conecta_mysql.inc';

$cpf= $_POST["cpfexc"];

$sql = "DELETE FROM cadusu WHERE cpf ='$cpf'";
if($conexao->query($sql) == TRUE){
    echo "Usuário excluído com sucesso!<br>";
    echo "<a href='../home.html' ><button >Voltar</button></a>";
}
else{
    echo "Erro: ". $sql. "<br>". $conexao->error;
    echo "<a href='../home.html' ><button >Voltar</button></a>";
}
$conexao->close();
?>