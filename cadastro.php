<?php

require_once "bibliotecas/mysqli.bli";
require_once "bibliotecas/conecta_mysqli.inc";
require_once "bibliotecas/ver_session.inc";

date_default_timezone_set("America/Fortaleza");

if(isset($_GET["table"])) { $table = $_GET["table"]; } else { header('Location: '. $_SERVER['PHP_SELF'] .'?table='. $ecommerce->tabelas[0]); die(); }
if(isset($_POST["enviar"])) {

    // Processo de recepção de dados para serem inseridos.

    $atributos = $ecommerce->descrever($table); // Resgata todos os atributos disponíveis na tabela selecionada.
    if(isset($_POST["rg2"]) && $_POST["rg2"] != NULL) { $RG = $_POST["rg1"]."-".$_POST["rg2"]; } // Está mesclando a sigla e os números do RG.

    foreach ($atributos as $atributo) { // Para cada atributo será preenchido com os dados recebidos
        $atributo = $atributo["Field"];
        if($atributo == "RG" && isset($RG)) { $data["RG"] = $RG; } // O caso especial do RG.
        if($atributo == "Imagem" && isset($_FILES["Imagem"])) {
            $endereco = "imagens/";        
            $target_path = $endereco . basename( $_FILES['Imagem']['name']); 
            $novoNome='foto'. rand(0,10000000000000) .'.jpg';
            
            if(move_uploaded_file($_FILES['Imagem']['tmp_name'], $endereco.$novoNome)) { echo "<br>Arquivo<b> ".  $endereco.$novoNome. " </b>enviado com sucesso<br>";}
            else { echo "<br>A imagem não foi enviada."; }

            $data["Imagem"] = $endereco.$novoNome;
        }
        if(isset($_POST[$atributo])) { $data["$atributo"] = $_POST[$atributo];} // Se o atributo existe, ele será enviado.
    }
    if($ecommerce->inserir($table, $data)) { echo "Cadastro efetivado com sucesso!<br>"; }
}

function select_foreign($database, $tabela, $foreign, $multiple = FALSE, $check = FALSE) {
        $data   = $database->buscar($tabela); // Pega todos os registros dentro da tabela especificada.
        $type   = $multiple ? "checkbox" : "radio"; // Alterna entre radio button ou checkbox.
        ?>
        <div class="select_foreign" style="overflow: auto; height: 100px; border: 1px solid black; margin: 5px;">
            <table border=1 style="border-collapse: collapse;" width="100%" cellpadding="5px">
                <tr>
                    <th> Selecionar </th>
                    <?php
                        foreach($database->descrever($tabela) as $atributo) { // Gera o cabeçalho da tabela.
                            if($atributo["Key"] == "PRI") { $ID = $atributo["Field"]; }
                            ?><th><?=$atributo["Field"]?></th><?php
                        }
                        if(!isset($ID)) { $data = "Erro: Não existe chave primária dentro de $tabela."; } // Checa se há chave primária, caso contrário, cancelará a tabela.
                    ?>
                </tr>
                <?php
                    if(is_array($data)) { foreach($database->buscar($tabela) as $linha) {
                        ?><tr align="center">
                            <td><input type="<?=$type?>" name="<?php if($multiple == TRUE) { echo $foreign.$linha[$ID]; } else { echo $foreign; }?>" value="<?=$linha[$ID]?>" <?php if($check == $linha["ID"]) { echo "checked"; } else { $error = "Erro: Chave estrangeira especificada não foi encontrada.<br>"; } ?>></td>
                            <?php if(is_array($linha)) {
                                foreach($linha as $registro) { ?><td><?=$registro?></td><?php }
                            } else { ?><td><?=$linha?></td><?php }
                            ?> 
                        </tr>
                <?php } } else { ?><tr><td colspan="100"><?=$data?></td></tr><?php }?>
            </table>
        </div>
        <?php
        // if(isset($error)) { return $error; }
}

?>

<html>
    <head>
        <title>Cadastro</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <style>
            fieldset { text-align: left; }
        </style>
    </head>
    <body>
        <h1>Área Administrativa</h1>
        <hr><br>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
            <select name="table"> <?php
                foreach($ecommerce->tabelas as $tabelas) { ?><option value="<?=$tabelas?>" <?php if($table == $tabelas) { echo "selected";} ?>><?=$tabelas?></option><?php } ?>
            </select>
            <input type="submit" value="Trocar">
        </form>
        <form action="<?=$_SERVER['PHP_SELF'] . "?table=$table"?>" method="POST" enctype="multipart/form-data">
            <fieldset>
                <?php
                    switch($table) {
                        case "usuario":
                            ?>
                                <legend><h2>Usuário</h2></legend>
                                <label>Email: </label> <input type="email" name="Email" placeholder="Insira aqui um novo email" maxlength="320" size="25" required><br>
                                <label>Senha: </label> <input type="password" name="Senha" placeholder="Digite a senha" maxlength="20" minlength="8" size="8" required><br>
                                <br>
                                <fieldset>
                                    <legend>Informações</legend>
                                        <label>Nome:                </label> <input type="text" name="Nome" placeholder="Digite o seu nome" maxlength="100" size="25" required>
                                    <br><label>Telefone:            </label> <input type="tel" name="Telefone" maxlength="15" placeholder="(00) 0000-000"> <!-- onkeyup="handlePhone(event)" -->
                                    <br><label>Sexo:                </label> <input type="radio" name="Sexo" value="M">Masculino <input type="radio" name="Sexo" value="F"> Feminino <input type="radio" name="Sexo" value="I"> Intersexo
                                    <br><label>Data de Nascimento:  </label> <input type="date" name="Nascimento" min="19<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" max="20<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" required>
                                    <br><label>CPF:                 </label> <input type="text" name="CPF" placeholder="Digite seu CPF"> <!-- oninput="mascaraCPF(this)" -->
                                    <br><label>RG:                  </label> <select name="rg1">
                                        <?php
                                            $uf = ["AC","AL","AP","AM","BA","CE","ES","GO","MA","MT","MS","MG","PA","PB","PR","PE","PI","RJ","RN","RS","RO","RR","SC","SP","SE","TO"];
                                            foreach($uf as $sigla) { ?><option value="<?=$sigla?>"><?=$sigla?></option><?php } 
                                        ?>
                                    </select> - <input type="text" name="rg2" maxlength="9" size="6" placeholder="12.345.678"> <!-- oninput="MascaraRG(event)" -->
                                    <input type="hidden" name="DataCriacao" value="<?=date("Y-m-d h:i:s")?>">
                                </fieldset>
                            <?php
                            break;
                        case "categoria":
                            ?>
                                <legend><h2>Categoria</h2></legend>
                                <label> Nome:           </label><input type="text" name="Nome" placeholder="Digite o nome da categoria" maxlength="20" size="20" required>
                                <br><label> Descrição:  </label>
                                <br><textarea cols=100 rows=5 placeholder="Descreva esta categoria, caso necessário, se, por exemplo, a categoria for muito específica." name="Desc"></textarea><br>
                            <?php
                            break;
                        case "produto":
                            ?>
                                <legend><h2>Produto</h2></legend>
                                <label> Nome:                       </label> <input type="text" name="Nome" placeholder="Digite o nome da produto" maxlength="100" size="20" required>
                                <br><label>Preço:                   </label> <input type="number" name="Preco" step="0.01" placeholder="1000.00" min="0" max="9999999" required>
                                <br><label>Imagem:                  </label> <input type="file" name="Imagem">
                                <br><label>Categoria:               </label> <select name="cat_id">
                                    <?php
                                        $categorias = $ecommerce->buscar("categoria");
                                        foreach ($categorias as $index => $categoria) { ?><option value="<?=$categoria["ID"]?>"><?=$categoria["Nome"]?></option><?php }
                                    ?>
                                </select>
                                <br><label>Desconto Inicial:        </label> <input type="number" name="Desconto" step="1" placeholder="0%" min="0" max="99.9" required>
                                <br><label>Quantidade de Estoque:   </label> <input type="number" name="Qtde" step="1" placeholder="1000" min="0" max="9999" required>
                                <br><label>Descrição:               </label>
                                <br><textarea cols=100 rows=5 placeholder="Descreva o seu produto com detalhes." name="Desc"></textarea><br>
                            <?php
                            break;
                        case "funcionario":
                            ?>
                                <legend><h1>Funcionário</h1></legend>
                                <label>Cargo: </label>
                                <select name="Cargo">
                                    <option value="Gerente">Gerente</option>
                                    <option value="RH">RH</option>
                                    <option value="Mercadologo">Mercadólogo</option>
                                    <option value="Vendedor">Vendedor</option>
                                </select>
                                <br><label>Salário:             </label><input type="number" name="Salario" step="0.01" placeholder="1000.00" min="0" max="9999999" required>
                                <br><label>Usuário:             </label><br><?=select_foreign($ecommerce, "usuario", "user_id", false)?>
                                <br><label>Data de Admissão:    </label><input type="date" name="Admissao" min="19<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" max="20<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" required>
                                <br>
                            <?php
                            break;
                        case "avaliacao":
                            ?>
                            <br><label>Estrelas:    </label> <input type="number" name="Salario" step="1" placeholder="5" min="0" max="5" required>
                            <br><label>Produto:     </label> <br><?=select_foreign($ecommerce, "produto", "prod_id", false)?>
                            <br><label>Usuário:     </label> <br><?=select_foreign($ecommerce, "usuario", "user_id", false)?>
                            <br><label>Descrição:   </label>
                            <br><textarea cols=100 rows=5 placeholder="Descreva o seu produto com detalhes." name="Desc"></textarea><br>
                            <?php
                            break;
                        case "carrinho":
                            ?>
                            <style> .select_foreign { height: 150px; } </style>
                            <br><label>Produto: </label> <br>
                            <div class="select_foreign" style="overflow: auto; height: 100px; border: 1px solid black; margin: 5px;">
                                <table border=1 style="border-collapse: collapse;" width="100%" cellpadding="5px">
                                    <tr>
                                        <th> Selecionar </th>
                                        <?php
                                            foreach($ecommerce->descrever("produto") as $atributo) {
                                                if($atributo["Key"] == "PRI") { $ID = $atributo["Field"]; }
                                                ?><th><?=$atributo["Field"]?></th><?php
                                            }
                                            if(!isset($ID)) { $data = "Erro: Não existe chave primária dentro de $table."; }
                                        ?>
                                        <th> Quantidade </th>
                                    </tr>
                                    <?php
                                        if(is_array($ecommerce->buscar("produto"))) { foreach($ecommerce->buscar("produto") as $linha) {
                                            ?><tr align="center">
                                                <td><input type="checkbox" name="prod_id<?=$linha["ID"]?>" value="<?=$linha["ID"]?>"></td>
                                                <?php if(is_array($linha)) {
                                                    foreach($linha as $registro) { ?><td><?=$registro?></td><?php }
                                                } else { ?><td><?=$linha?></td><?php }
                                                ?> 
                                                <td><input type="number" name="QuantidadeItem<?=$linha["ID"]?>" maxlength="59" value="1"></td>
                                            </tr>
                                    <?php } } else { ?><tr><td colspan="100"><?=$ecommerce->buscar("produto")?></td></tr><?php }?>
                                </table>
                            </div>
                            <br><label>Pedido:  </label> <br><?=select_foreign($ecommerce, "pedido", "Ped_id", false)?>
                            <?php
                            break;
                        case "cliente":
                            ?>
                            <br><label>CEP:                     </label> <input type="text" name="CEP" placeholder="Digite seu CEP">
                            <br><label>Número de Complemento:   </label> <input type="text" name="No_Cmplt" placeholder="Nº999" size="1" maxlength="3" min="1">
                            <br><label>Rua:                     </label> <input type="text" name="Rua" placeholder="Digite o nome da sua rua">
                            <br><label>Bairro:                  </label> <input type="text" name="Bairro" placeholder="Digite o nome da sua bairro">
                            <br><label>Apelido:                 </label> <input type="text" name="Apelido" placeholder="Insira algum apelido">
                            <br><label>Usuário:                 </label> <br><?=select_foreign($ecommerce, "usuario", "user_id", false)?>
                            <?php
                            break;
                        case "pedido":
                            ?>
                            <br><label>Data da Venda:       </label><input type="date" name="Data" min="19<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" max="20<?=date("y")?>-<?=date("m")?>-<?=date("d")?>" required>
                            <br><label>Método de Pagamento: </label>
                                <select name="Pag">
                                    <option value="Boleto">Boleto</option>
                                    <option value="Cartão de Crédito">Cartão de Crédito</option>
                                    <option value="Pix">Pix</option>
                                </select>
                            <br><label>Cliente:             </label><br><?=select_foreign($ecommerce, "cliente", "clid_id")?>
                            <?php
                            break;
                        default: $table = "produto";
                    }
                ?>
                <br><input type="submit" name="enviar" value="Cadastrar"> <input type="reset" value="Limpar">
            </fieldset>
        </form>

        <a href="./">Voltar</a>
        <br><br>
    </body>
    <!--
    <script>
        function mascaraCPF(i){
        
            var v = i.value;
            
            if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
            i.value = v.substring(0, v.length-1);
            return;
            }
            
            i.setAttribute("maxlength", "14");
            if (v.length == 3 || v.length == 7) i.value += ".";
            if (v.length == 11) i.value += "-";
        
        }
        const handlePhone = (event) => {
            let input = event.target
            input.value = phoneMask(input.value)
        }

        const phoneMask = (value) => {
            if (!value) return ""
            value = value.replace(/\D/g,'')
            value = value.replace(/(\d{2})(\d)/,"($1) $2")
            value = value.replace(/(\d)(\d{4})$/,"$1-$2")
            return value
        }
        function MascaraRG(event) {
            let input = event.target;
            let value = input.value;
            value = value.replace(/\D/g, '');
            value = value.replace(/^(\d{2})(\d{3})(\d{3})$/, '$1.$2.$3');
            input.value = value;
        }

    </script> -->
</html>