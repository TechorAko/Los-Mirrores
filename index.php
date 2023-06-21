<?php
    require_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/bli/load_front";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <title>Inicio - Los Mirrores</title>
        <?php include_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/bli/bootstrap/"; ?>
    </head>
	<body>
		<?php include_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/header.php"; ?>
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- shop -->
					<?php
		
						$collections = $ecommerce->fetch_multiarray("SELECT cat_nome, prod_id, prod_nome FROM categoria, produto WHERE produto.cat_id = categoria.cat_id ORDER BY RAND() DESC LIMIT 3", MYSQLI_ASSOC);
		
						foreach($collections as $coll) { 
							$imagem = $ecommerce->buscar("produto_galeria", "img_link", ["prod_id" => $coll["prod_id"]])[0]["img_link"];	
					?>
											
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img style="height:20vw; object-fit: cover; object-position: 50% 50%;" src="http://<?=$_SERVER['SERVER_NAME']?>/TechorAko/Los-Mirrores/assets/prod_img/<?=substr($imagem, -17)?>" alt="Imagem de exibição do produto" />
							</div>
							<div class="shop-body">
								<h3>Categorias<br><?= $coll['cat_nome']?></h3>
								<a href="http://<?=$_SERVER['SERVER_NAME']?>/Los-Mirrores/store.php?c=<?=$coll['cat_nome']?>" class="cta-btn">Comprar agora <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->
					<?php }?>
					<!-- shop -->
					
					<!-- /shop -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Novos Produtos</h3>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
										<?php

											$novos_produtos = $ecommerce->fetch_multiarray("SELECT cat_nome, prod_id, prod_nome, prod_preco, prod_dscnt, prod_criado FROM categoria, produto WHERE produto.cat_id = categoria.cat_id ORDER BY prod_criado DESC LIMIT 10", MYSQLI_ASSOC);
											foreach($novos_produtos as $produto) {

										?>
										<!-- product -->
										<div class="product">
											<a href="<?="http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/produto.php?p=" . $produto['prod_id']?>">
												<div class="product-img">
													<img src="<?=$ecommerce->buscar('produto_galeria', 'img_link', ['prod_id' => $produto['prod_id']])[0]['img_link']?>" alt="" height="250px;" style="object-fit: contain; object-position: 50% 50%;">
													<div class="product-label">
														<?php if(!empty($produto['prod_dscnt'])) { ?><span class="sale">-<?=$produto['prod_dscnt']?>%</span><?php } ?>
														<span class="new">NOVO</span>
													</div>
												</div>
												<div class="product-body">
													<p class="product-category"><?=rtrim($produto['cat_nome'], 'es')?></p>
													<h3 class="product-name">
														<?php

															$max_name_length = 35;

															if(strlen($produto['prod_nome']) < $max_name_length) {
																echo $produto['prod_nome'];
															} else {
																echo substr($produto['prod_nome'], 0, $max_name_length)."...";
															}

														?>
													</h3>
													<h4 class="product-price">R$<?php if(empty($produto['prod_dscnt'])) { echo $produto['prod_preco']; } else { echo round($produto['prod_preco'] - ($produto['prod_preco'] * ($produto['prod_dscnt'] * 0.01)), 2).' <del class="product-old-price">R$'. $produto['prod_preco'] .'</del>'; } ?></h4>
												</div>
											</a>
											<div class="add-to-cart">
												<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
													<button class="add-to-cart-btn" style="padding: 10px; padding-top: 8px;" type="submit" name="addcarrinho" value="<?=$produto['prod_id']?>">Adicionar ao carrinho</button>
												</form>
											</div>
										</div>
										<!-- /product -->
										<?php } ?>
									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<h2 class="text-uppercase">Promoção esta semana!</h2>
							<p>Novas coleções com 50% de desconto</p>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Mais vendidos</h3>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab2" class="tab-pane fade in active">
									<div class="products-slick" data-nav="#slick-nav-2">
										<!-- product -->
										<?php

											$mais_vendidos = $ecommerce->fetch_multiarray("SELECT cat_nome, prod_id, prod_nome, prod_preco, prod_dscnt, prod_criado, count(pedido.ped_id) as vendas FROM categoria, produto, pedido WHERE produto.cat_id = categoria.cat_id GROUP BY prod_id ORDER BY vendas DESC LIMIT 10", MYSQLI_ASSOC);
											foreach($mais_vendidos as $produto) {

										?>
										<!-- product -->
										<div class="product">
											<a href="<?="http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/produto.php?p=" . $produto['prod_id']?>">
												<div class="product-img">
													<img src="<?=$ecommerce->buscar('produto_galeria', 'img_link', ['prod_id' => $produto['prod_id']])[0]['img_link']?>" alt="" height="250px;" style="object-fit: contain; object-position: 50% 50%;">
													<div class="product-label">
														<?php if(!empty($produto['prod_dscnt'])) { ?><span class="sale">-<?=$produto['prod_dscnt']?>%</span><?php } ?>
													</div>
												</div>
												<div class="product-body">
													<p class="product-category"><?=rtrim($produto['cat_nome'], 'es')?></p>
													<h3 class="product-name">
															<?php

																$max_name_length = 35;

																if(strlen($produto['prod_nome']) < $max_name_length) {
																	echo $produto['prod_nome'];
																} else {
																	echo substr($produto['prod_nome'], 0, $max_name_length)."...";
																}

															?>
													</h3>
													<h4 class="product-price">R$<?php if(empty($produto['prod_dscnt'])) { echo $produto['prod_preco']; } else { echo round($produto['prod_preco'] - ($produto['prod_preco'] * ($produto['prod_dscnt'] * 0.01)), 2).' <del class="product-old-price">R$'. $produto['prod_preco'] .'</del>'; } ?></h4>
												</div>
											</a>
											<div class="add-to-cart">
												<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
													<button class="add-to-cart-btn" type="submit" name="addcarrinho" value="<?=$produto['prod_id']?>"><i class="fa fa-shopping-cart"></i> add to cart</button>
												</form>
											</div>
										</div>
										<!-- /product -->
										<?php } ?>
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<?php include_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/footer.php" ?>

		<?php include_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/bli/bootstrap/jquery_plugins.php"; ?>

	</body>
</html>


<?php

die();

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