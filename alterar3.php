<?php
   include "bibliotecas/conecta_mysqli.inc";
   include "bibliotecas/ver_session.inc";
    $cod = $_POST['cod'];
    $nome = $_POST['nome'];
$date = $_POST['date'];
$mail = $_POST['mail'];
$passw = $_POST['passw'];

    $sql = "UPDATE cadusu SET nome= '$nome',data_nasc = '$date',email = '$mail',passwor= '$passw' WHERE cod_usu= '$cod'";

    if($conexao->query($sql) === TRUE){
        echo "Usuário alterado com sucesso<br>";
        echo "<a href=alter.html>Voltar</a>";
    }
    else{
        echo "Erro: ". $sql. "<br>".$conexao->error;
        echo "<br><a href=alter.html>Voltar</a>";
    }
    $conexao->close();
?>