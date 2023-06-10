<?php

require_once "bibliotecas/mysqli.bli";
require_once "bibliotecas/conecta_mysqli.inc";
require_once "bibliotecas/ver_session.inc";

$sql = "SELECT produto.prod_id, prod_nome, prod_preco, cat_nome FROM produto, produto_filtro, filtro, categoria WHERE produto.prod_id = produto_filtro.prod_id AND filtro.cat_id = produto.cat_id AND produto_filtro.fltr_id = filtro.fltr_id AND categoria.cat_id = produto.cat_id AND filtro.cat_id = categoria.cat_id";

if(isset($_GET["s"]) && !empty($_GET["s"])) {
    $sql .= " AND prod_nome LIKE '%". addslashes($_GET["s"]) ."%'";
}

if(isset($_GET["c"]) && !empty($_GET["c"])) {
    if(is_array($_GET["c"])) {
        foreach($_GET["c"] as $categoria) {
            $sql .= " AND produto.cat_id = '". $categoria ."'";
        }
    } else {
        $sql .= " AND produto.cat_id = '". $categoria ."'";
    }
}

if(isset($_GET["f"]) && !empty($_GET["f"])) {
    if(is_array($_GET["f"])) {
        foreach($_GET["f"] as $filtro) {
            $sql .= " AND produto_filtro.fltr_id = '". $filtro ."'";
        }
    } else {
        $sql .= " AND produto_filtro.fltr_id = '". $filtro ."'";
    }
}

if(isset($_GET["pmin"]) && !empty($_GET["pmin"])) {
    $sql .= " AND prod_preco < '". $_GET["pmin"] ."'";
}
if(isset($_GET["pmax"]) && !empty($_GET["pmax"])) {
    $sql .= " AND prod_preco > '". $_GET["pmax"] ."'";
}

if(isset($_GET["order"]) && !empty($_GET["order"]) && $_GET["order"] != 0) {
    $_GET["by"] = !isset($_GET["by"]) ? "ASC" : $_GET["by"];
    $sql .= " ORDER BY ";
    switch($_GET["order"]) {
        case 1: $sql .= "produto.prod_nome "    . $_GET["by"]; break;
        case 2: $sql .= "produto.prod_preco "   . $_GET["by"]; break;
        case 3: $sql .= "produto.prod_dscnt "   . $_GET["by"]; break;
        case 4: $sql .= "categoria.cat_nome "   . $_GET["by"]; break;
        case 5: $sql .= "produto.prod_qtde "    . $_GET["by"]; break;
        case 6: $sql .= "produto.prod_criado "  . $_GET["by"]; break;
    }
}

$produtos = $ecommerce->fetch_multiarray($sql, MYSQLI_BOTH);


function check($value, $reference, $checked = "checked") {
    if(!is_array($value)) {
        if($value == $reference) { echo $checked; }
    } else {
        foreach($value as $v) {
            if($v == $reference) {
                echo $checked;
                break;
            }
        }
    }
}

?>

<html>
    <head>
        <title>Los Mirrores</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <style>
            li { list-style-type: none; }
        </style>
    </head>
    <body>
        <h1>Los Mirrores</h1>
        <hr>
        <br><a href="login.php?sair=1">Sair</a><br>
        <br>
        <table width="100%" border="1">
            <form action="<?=$_SERVER["PHP_SELF"]?>" method="GET">
                <tr><th colspan="100">Produtos</th></tr>
                <tr>
                    <th style="width: 0px;">Categorias</th>
                    <th>
                        <input type="text" name="s" placeholder="Pesquisar por chiclete mascavo..." <?php if(isset($_GET["s"])) { ?>value="<?=$_GET["s"]?>"<?php }?> style="width: 600px;">
                        <input type="submit" value="Pesquisar">
                    </th>
                    <th style="width: 300px;">
                        Ordenar por: <select name="order" onchange="this.form.submit()">
                            <?php
                                $orderby = ["Nenhum", "Ordem Alfabética", "Preço", "Desconto", "Categoria", "Quantidade", "Data"];
                                foreach($orderby as $order => $by) {
                                    ?><option value="<?=$order?>" <?php if(isset($_GET["order"])) { check($_GET["order"], $order, "selected"); } ?>><?=$by?></option><?php
                                }
                            ?>
                        </select>
                        <select name="by" onchange="this.form.submit()">
                            <?php
                                $bys = ["ASC" => "↑", "DESC" => "↓"];
                                foreach($bys as $order => $by) {
                                    ?><option value="<?=$order?>" <?php if(isset($_GET["order"])) { check($_GET["by"], $order, "selected"); } ?>><?=$by?></option><?php
                                }
                            ?>
                        </select>
                    </th>
                </tr>
                <tr>
                    <td style="vertical-align: top; height: 0px;">
                        <div style="overflow-y: auto; width: 250px; height: 350px;">
                            <ul>
                            <?php
    
                                $categorias = $ecommerce->buscar("categoria", "cat_id, cat_nome");
    
                                if(is_array($categorias)) {
                                    foreach($categorias as $categoria) {
                                        ?>
                                            <li><input type="checkbox" name="c[]" value="<?=$categoria["cat_id"]?>" <?php if(isset($_GET["c"])) { check($_GET["c"], $categoria["cat_id"]); }?> onchange="this.form.submit()"> <?=$categoria["cat_nome"]?></li>
                                            <ul>
                                                <?php
                                                    $filtros = $ecommerce->buscar("filtro", "fltr_id, fltr_nome", ["cat_id" => $categoria["cat_id"]]);
                                                    if(is_array($filtros)) {
                                                        foreach($filtros as $filtro) {
                                                            ?><li><input type="checkbox" name="f[]" value="<?=$filtro["fltr_id"]?>" <?php if(isset($_GET["f"])) { check($_GET["f"], $filtro["fltr_id"]); }?> onchange="this.form.submit()"> <?=$filtro["fltr_nome"]?></li><?php
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
                    </td>
                    <td rowspan="100" colspan="100">
                        <div style="overflow-y: auto; height: 500px;">
                            <table width="100%" border="1">
                                <?php

                                    if(is_array($produtos)) { foreach($produtos as $produto) { ?>
                                        <tr>
                                            <?php
                                                $imagem = $ecommerce->buscar("produto_galeria", "img_link", ["prod_id" => $produto["prod_id"]])[0]["img_link"];
                                            ?>
                                            <td><img src="<?=$imagem?>" style="width: 100px; height: 100px; object-fit: cover; object-position: 50% 50%;"></td>
                                            <td><?=$produto["prod_nome"]?></td>
                                            <td><?=$produto["cat_nome"]?></td>
                                            <td>R$<?=$produto["prod_preco"]?></td>
                                        </tr>
                                    <?php } } else { echo "Nenhum produto encontrado."; }
                                    
                                ?>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th style="width: 0px; height: 0px;">Preço</th>
                </tr>
                <tr>
                    <td align="center">
                        <input type="number" name="pmin" min="0.01" step="0.01" <?php if(isset($_GET["pmin"])) { ?>value="<?=$_GET["pmin"]?>"<?php }?> style="width: 50px;"> - <input type="number" name="pmax" min="0.01" step="0.01" <?php if(isset($_GET["pmax"])) { ?>value="<?=$_GET["pmax"]?>"<?php }?> style="width: 50px;">
                        <input type="submit" value="Confirmar">
                    </td>
                </tr>
            </form>
        </table>
    </body>
</html>