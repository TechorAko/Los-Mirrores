<?php
    include '../conecta_mysql.inc';
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $coments= $_POST['coments'];
    $cpf = $_POST['cpf'];

    $sql = "UPDATE cadusu SET nome = '$nome',cpf = '$cpf',email = '$email',cidade = '$cidade',estado = '$estado',coment = '$coments' WHERE cpf = '$cpf'";

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