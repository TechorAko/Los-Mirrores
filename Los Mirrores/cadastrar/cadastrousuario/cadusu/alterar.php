<html> 
    <head>
        <meta charset="utf-8">
        <title>Alteração de cadastro</title>
    </head>
    <body>
        <form method="POST" action="alterar2.php">
            <?php 
            include '../conecta_mysql.inc';
            if(isset($_POST['envio'])){
                include '../conecta_mysql.inc';
                $cpf = $_POST['cpf'];
                $email ='';
                $nome = '';
                $cidade = ''; 
                $estado = '';
                $coments = '';
            }
            $sql = "SELECT * FROM cadusu WHERE cpf='$cpf'";
            $select = $conexao -> query($sql);
            if($select){
                while($linha = mysqli_fetch_array($select)){
                    $nome = $linha['nome'];
                    $cpf = $linha['cpf'];
            $email = $linha['email'];
            $cidade = $linha['cidade'];
            $estado = $linha['estado'];
            $coments = $linha['coment'];
                }
            }
            else{  echo "Erro: ". $sql . "<br>" . $conexao->error; echo "<a href=../home.html>Voltar</a>";}
            ?>

            Nome: <input type="text" size="35" maxlength="256" name="nome" value="<?=$nome?>"/><br>
            CPF: <input type="text" size="11" value="<?=$cpf?>" maxlength="14" readonly="true" name="cpf" placeholder="xxx.xxx.xxx-xx" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
            Email: <input type="text" size="35" maxlength="256"  name="email" value="<?=$email?>"/><br>
            Cidade: <input type="text" size="35" maxlength="256" name="cidade" value="<?=$cidade?>"/><br>
            Estado: <input type="text" size="2" maxlength="2" name="estado" value="<?=$estado?>"/><br>
            Digite sua opinião sobre o site no espaço abaixo: <br>
            <textarea name="coments" cols="42" rows="5"><?php echo $coments; ?></textarea><br>
            <input type="submit" value="Alterar" name="Enviar">
        </form>
        <?php  $conexao->close(); ?>
        <!-- oi otávio :) -->
    </body>
</html>