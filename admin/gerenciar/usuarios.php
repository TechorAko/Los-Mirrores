<?php

    require_once '../load_admin.php';

    if(isset($_POST["usuario"])) {
        if(isset($_FILES["pfp"]) && !empty(basename($_FILES['pfp']['name']))) {
            $endereco = "../../assets/pfp/";
            $target_path = $endereco . basename($_FILES['pfp']['name']);
            $novoNome = rand(0,10000000000000) . substr(basename($_FILES['pfp']['name']), -4);
            
            if(!move_uploaded_file($_FILES['pfp']['tmp_name'], $endereco.$novoNome)) { echo "<br>A imagem não foi enviada."; }
    
            $_POST["usuario"]["user_pfp"] = $path."/assets/pfp/".$novoNome;
        }
        $ecommerce->inserir("usuario", $_POST["usuario"]);
        header("Location: ". $_SERVER["PHP_SELF"]);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários - Los Mirrores</title>
</head>
<body>
    <br><a href="../">Voltar</a>
    <br>
    <form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
        <br>Nome: <input type="text" name="usuario[user_nome]" required>
        <br>Email: <input type="email" name="usuario[user_email]" required>
        <br>Senha: <input type="password" name="usuario[user_senha]" required>
        <br>Nascimento: <input type="date" name="usuario[user_nascimento]" required>
        <br>Sexo: <input type="radio" name="usuario[user_sexo]" value="M"> M <input type="radio" name="usuario[user_sexo]" value="F"> F <input type="radio" name="usuario[user_sexo]" value="I"> I
        <br>CPF: <input type="text" name="usuario[user_cpf]">
        <br>RG: <input type="text" name="usuario[user_rg]">
        <br>Foto: <input type="file" name="pfp" accept="image/*" required>
        <br>
        <br><input type="submit" value="Criar Usuário">
    </form>
</body>
</html>