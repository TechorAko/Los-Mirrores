<?php

    require_once '../load_admin.php';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Relatórios - Los Mirrores</title>
    </head>
    <body>
        <br><a href="../">Voltar</a>
        <br>
        <h3>Produtos mais vendidos no mês.</h3>
        <div style="overflow-y: auto; height: 250px; border: 1px solid black;">
            <table width="100%" border=1>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Produto</th>
                    <th>Link</th>
                    <th>Total</th>
                    <th>Quantidade</th>
                    <th>Categoria</th>
                </tr>
                <?php
                    $produtos = $ecommerce->fetch_multiarray("SELECT produto.prod_id, prod_nome, sum(prod_preco) as total, sum(car_qtde) as qtde FROM carrinho, produto, pedido WHERE produto.prod_id = carrinho.prod_id AND pedido.ped_id = carrinho.ped_id GROUP BY produto.prod_id ORDER BY total DESC", MYSQLI_ASSOC);
                    if(is_array($produtos)) { foreach($produtos as $produto) {
                        ?>
                            <tr>
                                <td><?=$produto["prod_id"]?></td>
                                <td>
                                    <?php

                                        $imagem = $ecommerce->buscar("produto_galeria", "img_link", ["produto_galeria.prod_id" => $produto["prod_id"]])[0]["img_link"];

                                    ?>
                                    <img src="../../assets/prod_img/<?=substr($imagem, -17)?>" alt="Imagem de exibição do produto" height="75px" />
                                </td>
                                <td><?=$produto["prod_nome"]?></td>
                                <td style="width: 175px;">Link Hipotético</td>
                                <td>R$<?=$produto["total"]?></td>
                                <td><?=$produto["qtde"]?></td>
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
        </div>
        <h3>Clientes que mais compraram.</h3>
        <div style="overflow-y: auto; height: 250px; border: 1px solid black;">
            <table width="100%" border=1>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Cliente</th>
                    <th>Sexo</th>
                    <th>Idade</th>
                    <th>Local</th>
                    <th>Total R$</th>
                    <th>Nº de Compras</th>
                    <th>Data de Entrada</th>
                </tr>
                <?php
                    $usuarios = $ecommerce->fetch_multiarray("SELECT usuario.user_id, user_pfp, user_nome, user_sexo, year(user_nascimento) as user_nasc, sum(pedido.ped_total) as total, sum(carrinho.car_qtde) as qtde, user_criado FROM usuario, pedido, carrinho WHERE usuario.user_id = pedido.user_id AND carrinho.ped_id = pedido.ped_id GROUP BY usuario.user_id ORDER BY total DESC", MYSQLI_ASSOC);
                    if(is_array($usuarios)) { foreach($usuarios as $usuario) {
                        ?>
                            <tr>
                                <form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
                                    <td><?=$usuario["user_id"]?></td>
                                    <td>
                                        <img src="../../assets/prod_img/<?=substr($usuario["user_pfp"], -17)?>" alt="Imagem de exibição do cliente" height="75px" />
                                    </td>
                                    <td><?=$usuario["user_nome"]?></td>
                                    <td><?=$usuario["user_sexo"]?></td>
                                    <td><?=date("Y")-$usuario["user_nasc"]?></td>
                                    <td>
                                        <?php
                                        
                                            $endereco = $ecommerce->buscar("endereco, usuario", "end_regiao, end_estado, end_cidade", ["endereco.user_id" => "usuario.user_id"])[0];

                                        ?>
                                        <?=$endereco["end_regiao"] ." - ". $endereco["end_estado"] ." - ". $endereco["end_cidade"]?>
                                    </td>
                                    <td>R$<?=$usuario["total"]?></td>
                                    <td><?=$usuario["qtde"]?></td>
                                    <td><?=$usuario["user_criado"]?></td>
                                </form>
                            </tr>
                        <?php
                    } }
                ?>
            </table>
        </div>
        <h3>Compras por Clientes</h3>
        <div style="overflow-y: auto; height: 250px; border: 1px solid black;">
            <table width="100%" border=1>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Cliente</th>
                    <th>Valor</th>
                    <th>Quantidade de Compras</th>
                    <th>Produtos Comprados</th>
                </tr>
                <?php
                    $usuarios = $ecommerce->fetch_multiarray("SELECT usuario.user_id, usuario.user_pfp, usuario.user_nome, sum(pedido.ped_total) as total, count(pedido.ped_id) as compras FROM usuario, pedido WHERE usuario.user_id = pedido.user_id  GROUP BY usuario.user_id ORDER BY compras DESC", MYSQLI_ASSOC);
                    if(is_array($usuarios)) { foreach($usuarios as $usuario) {
                        ?>
                            <tr>
                                <td><?=$usuario["user_id"]?></td>
                                <td>
                                    <img src="../../assets/prod_img/<?=substr($usuario["user_pfp"], -17)?>" alt="Imagem de exibição do cliente" height="75px" />
                                </td>
                                <td><?=$usuario["user_nome"]?></td>
                                <td>R$<?=$usuario["total"]?></td>
                                <td><?=$usuario["compras"]?></td>
                                <td>
                                    <div style="overflow-y: auto; height: 100px; border: 1px solid black;">
                                    <table width="100%" border=1>
                                        <tr>
                                            <th>ID</th>
                                            <th>Produto</th>
                                            <th>Total</th>
                                            <th>Quantidade</th>
                                        </tr>
                                    <?php
                                        $carrinho = $ecommerce->fetch_multiarray("SELECT carrinho.prod_id, produto.prod_nome, produto.prod_preco * sum(carrinho.car_qtde) as total, sum(carrinho.car_qtde) as qtde FROM produto, carrinho, pedido WHERE produto.prod_id = carrinho.prod_id AND carrinho.ped_id = pedido.ped_id AND pedido.user_id = ". $usuario["user_id"] ." GROUP BY produto.prod_id ORDER BY total DESC", MYSQLI_ASSOC);
                                        foreach($carrinho as $produto) {
                                            ?>
                                                <tr>
                                                    <td><?=$produto["prod_id"]?></td>
                                                    <td><?=$produto["prod_nome"]?></td>
                                                    <td>R$<?=$produto["total"]?></td>
                                                    <td><?=$produto["qtde"]?></td>
                                                </tr>
                                            <?php
                                        }
                                    ?>
                                    </table>
                                </td>
                            </tr>
                        <?php
                    } }
                ?>
            </table>
        </div>
        <h3>Compras acima de R$150</h3>
        <div style="overflow-y: auto; height: 250px; border: 1px solid black;">
            <table width="100%" border=1>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Valor</th>
                    <th>Produtos</th>
                </tr>
                <?php
                    $usuarios = $ecommerce->fetch_multiarray("SELECT pedido.ped_id, usuario.user_nome, sum(pedido.ped_total) as total FROM usuario, pedido WHERE usuario.user_id = pedido.user_id AND pedido.ped_total >= '150' GROUP BY pedido.ped_id ORDER BY total DESC", MYSQLI_ASSOC);
                    if(is_array($usuarios)) { foreach($usuarios as $usuario) {
                        ?>
                            <tr>
                                <td><?=$usuario["ped_id"]?></td>
                                <td><?=$usuario["user_nome"]?></td>
                                <td>R$<?=$usuario["total"]?></td>
                                <td>
                                    <div style="overflow-y: auto; height: 100px; border: 1px solid black;">
                                    <table width="100%" border=1>
                                        <tr>
                                            <th>ID</th>
                                            <th>Produto</th>
                                            <th>Total</th>
                                            <th>Quantidade</th>
                                        </tr>
                                    <?php
                                        $carrinho = $ecommerce->fetch_multiarray("SELECT carrinho.prod_id, produto.prod_nome, produto.prod_preco * sum(carrinho.car_qtde) as total, sum(carrinho.car_qtde) as qtde FROM produto, carrinho, pedido WHERE produto.prod_id = carrinho.prod_id AND carrinho.ped_id = pedido.ped_id AND carrinho.ped_id = ". $usuario["ped_id"] ." GROUP BY produto.prod_id ORDER BY total DESC", MYSQLI_ASSOC);
                                        foreach($carrinho as $produto) {
                                            ?>
                                                <tr>
                                                    <td><?=$produto["prod_id"]?></td>
                                                    <td><?=$produto["prod_nome"]?></td>
                                                    <td>R$<?=$produto["total"]?></td>
                                                    <td><?=$produto["qtde"]?></td>
                                                </tr>
                                            <?php
                                        }
                                    ?>
                                    </table>
                                </td>
                            </tr>
                        <?php
                    } }
                ?>
            </table>
        </div>
        <h3>Compras acima de R$150</h3>
        <div style="overflow-y: auto; height: 250px; border: 1px solid black;">
            <table width="100%" border=1>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Valor</th>
                    <th>Produtos</th>
                </tr>
                <?php
                    $usuarios = $ecommerce->fetch_multiarray("SELECT pedido.ped_id, usuario.user_nome, sum(pedido.ped_total) as total FROM usuario, pedido WHERE usuario.user_id = pedido.user_id AND pedido.ped_total >= '150' GROUP BY pedido.ped_id ORDER BY total DESC", MYSQLI_ASSOC);
                    if(is_array($usuarios)) { foreach($usuarios as $usuario) {
                        ?>
                            <tr>
                                <td><?=$usuario["ped_id"]?></td>
                                <td><?=$usuario["user_nome"]?></td>
                                <td>R$<?=$usuario["total"]?></td>
                                <td>
                                    <div style="overflow-y: auto; height: 100px; border: 1px solid black;">
                                    <table width="100%" border=1>
                                        <tr>
                                            <th>ID</th>
                                            <th>Produto</th>
                                            <th>Total</th>
                                            <th>Quantidade</th>
                                        </tr>
                                    <?php
                                        $carrinho = $ecommerce->fetch_multiarray("SELECT carrinho.prod_id, produto.prod_nome, produto.prod_preco * sum(carrinho.car_qtde) as total, sum(carrinho.car_qtde) as qtde FROM produto, carrinho, pedido WHERE produto.prod_id = carrinho.prod_id AND carrinho.ped_id = pedido.ped_id AND carrinho.ped_id = ". $usuario["ped_id"] ." GROUP BY produto.prod_id ORDER BY total DESC", MYSQLI_ASSOC);
                                        foreach($carrinho as $produto) {
                                            ?>
                                                <tr>
                                                    <td><?=$produto["prod_id"]?></td>
                                                    <td><?=$produto["prod_nome"]?></td>
                                                    <td>R$<?=$produto["total"]?></td>
                                                    <td><?=$produto["qtde"]?></td>
                                                </tr>
                                            <?php
                                        }
                                    ?>
                                    </table>
                                </td>
                            </tr>
                        <?php
                    } }
                ?>
            </table>
        </div>
    </body>
</html>