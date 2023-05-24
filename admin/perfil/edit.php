<?php

    require_once "../../bibliotecas/mysqli.bli";
    require_once "../../bibliotecas/conecta_mysqli";
    require_once "../ver_session";

    if(isset($_POST["RG"]) && !empty($_POST["RG"][1])) { $_POST["user"]["RG"] = implode("-", $_POST["RG"]); } else { $_POST["user"]["RG"] = NULL; }
    if(isset($_FILES["pfp"]) && !empty(basename($_FILES['pfp']['name']))) {
        $endereco = "../../assets/pfp/";
        $target_path = $endereco . basename($_FILES['pfp']['name']);
        $novoNome = rand(0,10000000000000) . substr(basename($_FILES['pfp']['name']), -4);
        
        if(!move_uploaded_file($_FILES['pfp']['tmp_name'], $endereco.$novoNome)) { echo "<br>A imagem não foi enviada."; }

        $_POST["user"]["pfp_link"] = $path."/assets/pfp/".$novoNome;
    }
    
    if ($ecommerce->alterar("usuario", $_POST["user"], ["ID" => $_SESSION["user_id"]])){ header("Location: ./?success"); die(); } else { header("Location: ./?edit=incomplete"); die(); }

?>