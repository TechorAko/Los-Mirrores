<?php

require_once "../../bibliotecas/mysqli.bli";
require_once "../../bibliotecas/conecta_mysqli";
require_once "../ver_session";

$user = $ecommerce->buscar("usuario", "*", ["ID" => $_SESSION["user_id"]])[0];

if(isset($_GET["edit"])) {
    switch($_GET["edit"]) {
        case "error":
            $alert = ["content" => "<b>Erro:</b> Não foi possível encontrar algum(as) informação(ões) necessária(s), por favor, preencha todos os campos obrigatórios.", "context" => "danger"];
            break;
        case "invalid":
            $alert = ["content" => "<b>Erro:</b> Campo(s) não preenchido(s) corretamente.", "context" => "danger"];
            break;
        case "incomplete":
            $alert = ["content" => "<b>Erro:</b> Não pode ser feito a(s) alteração(ões).", "context" => "danger"];
            break;
        default:
    }
} else if (isset($_GET["success"])) {
    $alert = ["content" => "Alteração(ões) feita(s) com sucesso!", "context" => "success"];
}

function selected($reference, $compare, $button = FALSE) {
    $select = $button ? "checked" : "selected";
    if($reference == $compare) { return $select; }
}

function null_check($value) {
    if($value == NULL) {
        return "<b class='text-muted'>Não informado</b>";
    } else {
        return $value;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../style.css">
        <title>Perfil - Los Mirrores (Administração)</title>
        <?php include_once '../../bibliotecas/bootstrap.html'; ?>
    </head>
    <body class="bg-lightgray">
        <?php include_once '../header.php'; ?>
        <div class="container bg-light my-2 py-4 px-4">
            <?php if(isset($_GET["edit"])) { ?>
            <form action="edit.php" method="POST" class="form" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xl-4">
                        <img src="<?php if(isset($user["pfp_link"])) { echo $user["pfp_link"]; } else { echo "https://i.pinimg.com/736x/cd/f8/56/cdf856897e44cd50571ded6d83b17572.jpg"; } ?>" class="rounded-circle mx-auto d-block" alt="Foto de perfil do usuário" style=" margin-bottom: 25px; width: 325px; height: 325px; object-fit:cover; object-position:50% 50%;">
                        <div class="custom-file mb-4">
                            <input type="file" class="custom-file-input" id="customFile" name="pfp" accept="image/*">
                            <label class="custom-file-label" for="customFile" id="custom-file-label">Escolher imagem</label>
                            <script>
                                $('#customFile').change(function(){
                                var filename = $(this)[0].files[0].name;
                                var max_length = 25;
                                if(filename.length > max_length) {
                                    filename = filename.slice(0,max_length);
                                    filename = filename + "...";
                                }
                                document.getElementById("custom-file-label").innerHTML = filename;

                                });
                                function displayfilename() {
                                $('#customFile').trigger('change');
                                }
                            </script>
                        </div>
                    </div>
                    <div class="col-md form-group">
                        <div class="col-md form-group">
                            <div class="row">
                                <div class="col-md form-group">
                                    <label for="name">Nome: <b class="text-danger">*</b></label>
                                    <input type="text" class="form-control" placeholder="Digite o seu nome" id="name" name="user[Nome]" value="<?php if(isset($user["Nome"])) { echo $user["Nome"]; } ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md form-group">
                                    <label for="email">Email: <b class="text-danger">*</b></label>
                                    <input type="email" class="form-control" placeholder="exemplo@email.com" id="email" name="user[Email]" value="<?php if(isset($user["Email"])) { echo $user["Email"]; } ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md form-group">
                                    <label for="nasc">Data de Nascimento: <b class="text-danger">*</b></label>
                                    <input type="date" class="form-control" name="user[Nascimento]" value="<?php if(isset($user["Nascimento"])) { echo $user["Nascimento"]; } ?>" required>
                                </div>
                                <div class="col-md form-group">
                                    <label for="sex">Sexo: </label>
                                    <select name="user[Sexo]" class="custom-select" id="sex">
                                        <?php
                                            $sexes = ["Prefiro não dizer" => "","Masculino" => "M", "Feminino" => "F", "Intersexo" => "I"];
                                            foreach($sexes as $sex => $value) { ?><option value="<?=$value?>" <?php if(isset($user["Sexo"])) { echo selected($user["Sexo"], $value); } ?>><?=$sex?></option><?php } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md form-group">
                                    <label for="telephone">Telefone:</label>
                                    <input type="tel" class="form-control" placeholder="+xx (xx) xxxxx-xxxx" id="telephone" name="user[Telefone]" value="<?php if(isset($user["Telefone"])) { echo $user["Telefone"]; } ?>">
                                </div>
                                <div class="col-md form-group">
                                    <label for="cpf">CPF:</label>
                                    <input type="text" class="form-control" placeholder="xxx.xxx.xxx-xx" id="cpf" name="user[CPF]" value="<?php if(isset($user["CPF"])) { echo $user["CPF"]; } ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md form-group">
                                    <label for="rg">RG:</label>
                                    <div class="row">
                                        <div class="col-md form-group">
                                            <select name="RG[0]" class="custom-select" id="rg">
                                                <?php
                                                    $RG = explode("-", $user["RG"]);
                                                    $uf = ["AC","AL","AP","AM","BA","CE","ES","GO","MA","MT","MS","MG","PA","PB","PR","PE","PI","RJ","RN","RS","RO","RR","SC","SP","SE","TO"];
                                                    foreach($uf as $sigla) { ?><option value="<?=$sigla?>" <?php if(isset($RG[0])) { echo selected($RG[0], $sigla); } ?>><?=$sigla?></option><?php } 
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-10 form-group">
                                            <input type="text" class="form-control" placeholder="xx.xxx.xxx" id="rg" name="RG[1]" value="<?php if(isset($RG[1])) { echo $RG[1]; } ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container d-flex justify-content-center">
                    <button type="submit" class="btn btn-success mx-5">Confirmar</button> <button type="button" onclick="window.location.assign('./')" class="btn btn-danger mx-5">Cancelar</button>
                </div>
                <input type="hidden" name="user[DataCriacao]" value="<?=date('Y-m-d H:i:s')?>">
            </form>

            <?php } else { ?>
            
            <div class="row">
                <div class="col-xl-4">
                    <img src="<?php if(isset($user["pfp_link"])) { echo $user["pfp_link"]; } else { echo "../../assets/blank_pfp.webp"; } ?>" class="rounded-circle mx-auto d-block" alt="Foto de perfil do usuário" style=" margin-bottom: 25px; width: 325px; height: 325px; object-fit:cover; object-position:50% 50%;">
                </div>
                <div class="col-md form-group">
                    <div class="col-md form-group">
                        <div class="row">
                            <div class="col-md form-group pt-2">
                                <h1>
                                    <?php
                                        if(isset($user["Nome"]) && $user["Nome"] != NULL) {
                                            echo $user["Nome"];
                                        } else {
                                            ?><script>window.location.assign("./?edit=error")</script><?php
                                            die();
                                        }
                                    ?>
                                </h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md form-group">
                                <label for="email">Email: </label>
                                <h4>
                                    <?php
                                        if(isset($user["Email"]) && $user["Email"] != NULL) {
                                            echo $user["Email"];
                                        } else {
                                            ?><script>window.location.assign("./?edit=error")</script><?php
                                            die();
                                        }
                                    ?>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md form-group">
                                <label for="nasc">Data de Nascimento: </label>
                                <h4>
                                <?php
                                    if(isset($user["Nascimento"]) && $user["Nascimento"] != NULL) {
                                        $nascimento = explode("-",$user["Nascimento"]);
                                        for($i = count($nascimento)-1 ; $i >= 0 ; $i--) { echo $nascimento[$i]; if($i != 0) { echo "/"; } }
                                    } else {
                                        ?><script>window.location.assign("./?edit=error")</script><?php
                                        die();
                                    }
                                ?>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md form-group">
                                <label for="sex">Sexo: </label>
                                <h4>
                                    <?php
                                        switch($user["Sexo"]) {
                                            case "M": echo "Masculino"; break;
                                            case "F": echo "Feminino"; break;
                                            case "I": echo "Intersexo"; break;
                                            default: echo "Prefiro não dizer";
                                        }
                                    ?>
                                </h4>
                            </div>
                            <div class="col-md form-group">
                                <label for="telephone">Telefone:</label>
                                <h4><?=null_check($user["Telefone"])?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md form-group">
                                <label for="cpf">CPF:</label>
                                <h4><?=null_check($user["CPF"])?></h4>
                            </div>
                            <div class="col-md form-group">
                                <label for="rg">RG:</label>
                                <h4><?=null_check($user["RG"])?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container d-flex justify-content-center my-2">
                <button type="button" onclick="window.location.assign('./?edit=1')" class="btn btn-secondary mx-5">Editar</button><button type="button" onclick="window.location.assign('../')" class="btn btn-secondary mx-5">Voltar</button> 
            </div>
            <?php } ?>
        </div>
    </body>
</html>