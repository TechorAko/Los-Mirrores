<?php

    require_once '../load_admin.php';

    if(isset($_POST["pedido"])) {

        $_POST["pedido"]["end_id"] = $ecommerce->buscar("endereco", "end_id", ["user_id" => $_POST["pedido"]["user_id"]])[0]["end_id"];
        $ecommerce->inserir("pedido", $_POST["pedido"]);
        $insert_id = $ecommerce->insert_id;

        $total = 0;

        foreach($_POST["itens"] as $prod_id => $qtde) {
            if($qtde <= 0) { continue; }
            $ecommerce->inserir("carrinho", ["prod_id" => $prod_id, "car_qtde" => $qtde, "ped_id" => $insert_id]);
            $total += $ecommerce->buscar("produto", "prod_preco", ["prod_id" =>$prod_id])[0]["prod_preco"];
        }
        $ecommerce->alterar("pedido", ["ped_total" => $total], ["ped_id" => $insert_id]);

    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pedidos - Los Mirrores</title>
    </head>
    <body>
        <br><a href="../">Voltar</a><br>
        <form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
            <br>Forma de Pagamento: <select name="pedido[ped_pag]">
                <?php

                    $formas = ["Boleto", "Cartão de Crédito", "Pix"];
                    foreach($formas as $forma) { ?><option value="<?=$forma?>"><?=$forma?></option><?php }

                ?>
            </select>
            <br>Usuário: <select name="pedido[user_id]">
                <?php

                $usuarios = $ecommerce->buscar("usuario");
                foreach($usuarios as $usuario) { ?><option value="<?=$usuario["user_id"]?>"><?=$usuario["user_nome"]?></option><?php }

                ?>
            </select>
            <table width="100%" border=1>
                <tr>
                    <th>Comprar</th>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Desconto</th>
                    <th>Quantidade</th>
                    <th>Filtros</th>
                    <th>Categoria</th>
                </tr>
                <?php
                    $produtos = $ecommerce->buscar("produto", "*");
                    if(is_array($produtos)) { foreach($produtos as $produto) {
                        ?>
                            <tr>
                                <td style="width: 0px;"><input type="number" value="0" name="itens[<?=$produto["prod_id"]?>]" min="0"></td>
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
                            </tr>
                        <?php
                    } }
                ?>
            </table>
            <br><input type="submit" value="Gerar pedido">
            <br>
        </form>
    </body>
</html>