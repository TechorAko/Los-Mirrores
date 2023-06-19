<?php

    require_once '../load_admin.php';

    if(isset($_POST["produto"])) {
        $ecommerce->inserir("produto", $_POST["produto"]);
        $prod_id = $ecommerce->insert_id;

        $total = count($_FILES['galeria']['name']);
        for($i = 0 ; $i < $total ; $i++) {
            $novoNome = rand(0,10000000000000) . substr(basename($_FILES['galeria']['name'][$i]), -4);
            $target_path = "../../assets/prod_img/" . $novoNome ;
            if(!move_uploaded_file($_FILES['galeria']['tmp_name'][$i], $target_path)) { die("Erro: Não foi possível enviar a imagem."); };
            $ecommerce->inserir("produto_galeria", ["img_link" => $path."/assets/prod_img/".$novoNome, "prod_id" => $prod_id]);
        }

        foreach($_POST["produto_filtro"] as $filtro) { $ecommerce->inserir("produto_filtro", ["prod_id" => $prod_id, "fltr_id" => $filtro]); }

        header("Location: ". $_SERVER["PHP_SELF"]);
    }

    if(isset($_POST["filtro"])) {
        $ecommerce->inserir("filtro", $_POST["filtro"]);
        setcookie("cat_id", $_POST["filtro"]["cat_id"]);
        header("Location: ". $_SERVER["PHP_SELF"]);
    }

    if(isset($_POST["categoria"])) {
        $ecommerce->inserir("categoria", $_POST["categoria"]);
        header("Location: ". $_SERVER["PHP_SELF"]);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produtos - Los Mirrores</title>
    <style>
        td { vertical-align: top; }
    </style>
</head>
<body>
    <table width="100%">
        <tr>
            <td>
                <a href="../">Voltar</a>
                <form action="<?=$_SERVER["PHP_SELF"]?>" method="POST" enctype="multipart/form-data">
                    <br>Nome: <input type="text" name="produto[prod_nome]" required>
                    <br>Descrição:
                    <br><textarea name="produto[prod_desc]" required></textarea>
                    <br>Categoria: <select name="produto[cat_id]">
                        <?php

                        $categorias = $ecommerce->buscar("categoria");
                        foreach($categorias as $categoria) {
                            ?><option value="<?=$categoria["cat_id"]?>" <?php if(isset($_COOKIE["cat_id"]) && $categoria["cat_id"] == $_COOKIE["cat_id"]) { echo "selected"; } ?>><?=$categoria["cat_nome"]?></option><?php
                        }

                        ?>
                    </select>
                    <br>Preço: <input type="number" name="produto[prod_preco]" step="0.01" min="0.01" max="9999" placeholder="0.00" required>
                    <br>Desconto: <input type="number" name="produto[prod_dscnt]" min="0" max="99"  placeholder="0%">
                    <br>Quantidade: <input type="number" name="produto[prod_qtde]" min="0" max="9999" placeholder="1000" required>
                    <br>Imagens: <input type="file" name="galeria[]" accept="image/*" multiple required>
                    <br>Filtros:
                    <div style="overflow-y: auto; max-height: 300px; width: 250px;">
                        <ul>
                        <?php

                            $categorias = $ecommerce->buscar("categoria", "cat_id, cat_nome");

                            if(is_array($categorias)) {
                                foreach($categorias as $categoria) {
                                    ?>
                                        <li><?=$categoria["cat_nome"]?></li>
                                        <ul>
                                            <?php
                                                $filtros = $ecommerce->buscar("filtro", "fltr_id, fltr_nome", ["cat_id" => $categoria["cat_id"]]);
                                                if(is_array($filtros)) {
                                                    foreach($filtros as $filtro) {
                                                        ?><li><input type="checkbox" name="produto_filtro[]" value="<?=$filtro["fltr_id"]?>"> <?=$filtro["fltr_nome"]?></li><?php
                                                    }
                                                }
                                            ?>
                                        </ul>
                                    <?php
                                }
                            }
                        ?>
                        </ul>
                    </div>
                    <br>
                    <br><input type="submit" value="Criar Produto">
                </form>
            </td>
            <td>
                <form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
                    <br>Nome: <input type="text" name="filtro[fltr_nome]">
                    <br>Categoria: <select name="filtro[cat_id]">
                        <?php

                            $categorias = $ecommerce->buscar("categoria");
                            foreach($categorias as $categoria) {
                                ?><option value="<?=$categoria["cat_id"]?>" <?php if(isset($_COOKIE["cat_id"]) && $categoria["cat_id"] == $_COOKIE["cat_id"]) { echo "selected"; } ?>><?=$categoria["cat_nome"]?></option><?php
                            }

                        ?>
                    </select>
                    <br>
                    <br><input type="submit" value="Criar Filtro">
                </form>
            </td>
            <td>
                <form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
                    <br>Nome: <input type="text" name="categoria[cat_nome]">
                    <br>Descrição:
                    <br><textarea name="categoria[cat_desc]"></textarea>
                    <br>
                    <br><input type="submit" value="Criar Categoria">
                </form>
            </td>
        </tr>
    </table>
    <br>
    <table width="100%" border=1>
        <tr>
            <th>ID</th>
            <th>Foto</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Desconto</th>
            <th>Quantidade</th>
            <th>Data de Criação</th>
            <th>Filtros</th>
            <th>Categoria</th>
        </tr>
        <?php
            $produtos = $ecommerce->buscar("produto", "*");
            if(is_array($produtos)) { foreach($produtos as $produto) {
                ?>
                    <tr>
                        <form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
                            <td><?=$produto["prod_id"]?></td>
                            <td>
                                <?php

                                    $imagem = $ecommerce->buscar("produto_galeria", "img_link", ["produto_galeria.prod_id" => $produto["prod_id"]])[0]["img_link"];

                                ?>
                                <img src="../../assets/prod_img/<?=substr($imagem, -17)?>" alt="Imagem de exibição do produto" height="75px" />
                            </td>
                            <td><?=$produto["prod_nome"]?></td>
                            <td style="width: 175px;"><div style="overflow: auto; height: 75px; width: 175px;"><?=$produto["prod_desc"]?></div></td>
                            <td><?=$produto["prod_preco"]?></td>
                            <td><?php if(isset($produto["prod_dscnt"]) && !empty($produto["prod_dscnt"])) { echo $produto["prod_dscnt"]."%"; } else { echo "Não há desconto"; }?></td>
                            <td><?=$produto["prod_qtde"]?></td>
                            <td><?=$produto["prod_criado"]?></td>
                            <td>
                                <?php

                                    $filtros = $ecommerce->buscar("filtro, produto_filtro", "filtro.fltr_nome", ["filtro.fltr_id" => "produto_filtro.fltr_id", "produto_filtro.prod_id" => $produto["prod_id"]]);
                                    if(is_array($filtros)) { foreach ($filtros as $filtro) {
                                        echo $filtro["fltr_nome"] ."\n<br>";
                                    } }

                                ?>
                            </td>
                            <td>
                                <?php

                                    $categorias = $ecommerce->buscar("categoria, produto", "categoria.cat_nome", ["produto.cat_id" => "categoria.cat_id", "produto.prod_id" => $produto["prod_id"]]);
                                    if(is_array($categorias)) { foreach ($categorias as $categoria) {
                                        echo $categoria["cat_nome"] ."\n<br>";
                                    } }

                                ?>
                            </td>
                        </form>
                    </tr>
                <?php
            } }
        ?>
    </table>
</body>
</html>