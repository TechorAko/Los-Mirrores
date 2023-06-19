<?php
    require_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/bli/load_front";

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

	$sql = "SELECT cat_nome, produto.prod_id, prod_nome, prod_preco, prod_dscnt, prod_qtde, prod_criado, count(carrinho.prod_id) as vendas FROM produto, categoria, produto_filtro, carrinho WHERE produto.prod_id = carrinho.prod_id AND produto.prod_id = produto_filtro.prod_id AND produto.cat_id = categoria.cat_id";

	if(isset($_GET["s"]) && !empty($_GET["s"])) { $sql .= " AND (prod_nome LIKE '%". $_GET["s"] ."%' OR prod_desc LIKE '%". $_GET["s"] ."%')"; }
	if(isset($_GET["c"]) && !empty($_GET["c"])) {
		if(!is_array($_GET["c"])) { $sql .= " AND produto.cat_id = '". $_GET["c"] ."'"; }
		else {
			
			$sql .= " AND (";
			foreach($_GET["c"] as $categoria) {
				$sql .= "produto.cat_id = '". $categoria ."' OR ";
			}
			$sql = rtrim($sql, " OR ");
			$sql .= ")";
		}
	}
	if(isset($_GET["f"]) && !empty($_GET["f"])) {
		if(!is_array($_GET["f"])) { $sql .= " AND produto.cat_id = '". $_GET["f"] ."'"; }
		else {
			
			$sql .= " AND (";
			foreach($_GET["f"] as $filtro) {
				$sql .= "produto_filtro.fltr_id = '". $filtro ."' OR ";
			}
			$sql = rtrim($sql, " OR ");
			$sql .= ")";
		}
	}
	if(isset($_GET["min"])) { $sql .= " AND prod_preco >= '". $_GET["min"] ."'"; }
	if(isset($_GET["max"])) { $sql .= " AND prod_preco <= '". $_GET["max"] ."'"; }

	$sql .= " GROUP BY produto.prod_id";

	$_GET["by"] = isset($_GET["by"]) ? $_GET["by"] : "ASC";

	if(isset($_GET["order"]) && !empty($_GET["order"])) {
		$sql .= " ORDER BY ";
		switch($_GET["order"]) {
			case 0: $sql .= "vendas"			; break;
			case 1: $sql .= "prod_preco"		; break;
			case 2: $sql .= "prod_dscnt"		; break;
			case 3: $sql .= "prod_qtde"			; break;
			case 4: $sql .= "prod_nome"			; break;
			case 5: $sql .= "prod_criado"		; break;
			case 6: $sql .= "categoria.cat_nome"; break;
			default: $sql .= "prod_preco"		; break;
		}
		$sql .= " ". $_GET["by"];
	}

	$_GET["limit"] = isset($_GET["limit"]) ? $_GET["limit"] : "20";
	$sql .= " LIMIT ". $_GET["limit"];

	$produtos = $ecommerce->fetch_multiarray($sql, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Electro - HTML Ecommerce Template</title>
 		<?php include_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/bli/bootstrap/"; ?>
    </head>
	<body>
		<?php include_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/header.php" ?>

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<form action="<?=$_SERVER["PHP_SELF"]?>" method="GET">
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Categorias</h3>
							<div class="checkbox-filter">

								<?php

									$categorias = $ecommerce->buscar("categoria, produto", "categoria.cat_id, cat_nome, count(prod_id) as total", ["categoria.cat_id" => "produto.cat_id"], FALSE, ["cat_nome" => "ASC"], "categoria.cat_id");
										
									if(is_array($categorias)) {
										foreach($categorias as $categoria) {
											if($categoria["cat_nome"] == "Marcas") { continue; }

								?>

									<div class="input-checkbox">
										<input type="checkbox" id="category-<?=$categoria["cat_id"]?>" name="c[]" onchange="this.form.submit()" value="<?=$categoria["cat_id"]?>" <?php if(isset($_GET["c"])) { check($_GET["c"], $categoria["cat_id"]); } ?>>
										<label for="category-<?=$categoria["cat_id"]?>">
											<span></span>
											<?=$categoria["cat_nome"]?>
											<small>(<?=$categoria["total"]?>)</small>
										</label>
									</div>
									<?php

										$fn = 0;

										$filtros = $ecommerce->buscar("filtro, produto_filtro", "filtro.fltr_id, fltr_nome, count(pf_id) as total", ["cat_id" => $categoria["cat_id"], "filtro.fltr_id" => "produto_filtro.fltr_id"], FALSE, ["fltr_nome" => "ASC"], "filtro.fltr_id");
										if(is_array($filtros)) {
											foreach($filtros as $filtro) {
									?>
										<div class="input-checkbox" style="margin-left: 25px;">
											<input type="checkbox" id="filter-<?=$filtro["fltr_id"]?>" name="f[]" value="<?=$filtro["fltr_id"]?>" <?php if(isset($_GET["f"])) { check($_GET["f"], $filtro["fltr_id"]); } ?> onchange="this.form.submit()">
											<label for="filter-<?=$filtro["fltr_id"]?>">
												<span></span>
												<?=$filtro["fltr_nome"]?>
												<small>(<?=$filtro["total"]?>)</small>
											</label>
										</div>
									<?php } } ?>

								<?php } } ?>

							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Preço</h3>
							<div class="price-filter" style="text-align: center;">
								<div id="price-slider"></div>
								<div class="input-number price-min">
									<input id="price-min" type="number" name="min">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
									<input id="price-max" type="number" name="max">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<button class="btn btn-danger" type="submit" style="margin-top: 15px;">Confirmar</button>
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Marcas</h3>
							<div class="checkbox-filter">
								<?php

									$marcas = $ecommerce->buscar('filtro, produto_filtro', 'filtro.fltr_id, fltr_nome, count(pf_id) as total', ["filtro.fltr_id" => "produto_filtro.fltr_id", "cat_id" => 2]);

									foreach($marcas as $marca) {
								?>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-<?=$marca["fltr_id"]?>" name="f[]" value="<?=$marca["fltr_id"]?>" <?php if(isset($_GET["f"])) { check($_GET["f"], $marca["fltr_id"]); } ?> onchange="this.form.submit()">
									<label for="brand-<?=$marca["fltr_id"]?>">
										<span></span>
										<?=$marca["fltr_nome"]?>
										<small>(<?=$marca["total"]?>)</small>
									</label>
								</div>
								<?php } ?>
							</div>
						</div>
						<!-- /aside Widget -->

					</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
								<label>
									Ordernar por:
									<select class="input-select" name="order" onchange="this.form.submit()">
									<?php
										$order  = ["Popularidade", "Preço", "Desconto", "Quantidade", "Ordem Alfabética", "Data", "Categoria"];
										foreach($order as $key => $value) { ?> <option value="<?=$key?>" <?php if(isset($_GET["order"])) { check($_GET["order"], $key, "selected"); } ?>><?=$value?></option> <?php } ?>
									</select>
									<?php

										switch($_GET["by"]) {
											case "ASC": echo '<button type="submit" class="btn" name="by" value="DESC" style="border-radius: 100%; margin-left: 10px;"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>';
												break;
											case "DESC": echo '<button type="submit" class="btn" name="by" value="ASC" style="border-radius: 100%; margin-left: 10px;"><i class="fa fa-arrow-down" aria-hidden="true"></i></button>';
												break;
											default: echo '<button type="submit" class="btn" name="by" value="ASC" style="border-radius: 100%; margin-left: 10px;"><i class="fa fa-arrow-down" aria-hidden="true"></i></button>';
										}

									?>
								</label>

								<label>
									Mostrar: 
									<select class="input-select" name="limit" onchange="this.form.submit()">
										<?php
											$show  = ["20", "50", "100"];
											foreach($show as $value) { ?> <option value="<?=$value?>" <?php if(isset($_GET["limit"])) { check($_GET["limit"], $value, "selected"); } ?>><?=$value?></option> <?php } ?>
									</select>
								</label>
							</div>
							<ul class="store-grid">
								<li class="active"><i class="fa fa-th"></i></li>
								<li><a href="#"><i class="fa fa-th-list"></i></a></li>
							</ul>
							</form>
						</div>
						<!-- /store top filter -->

						<!-- store products -->
						<div class="row">
							<?php

								if(is_array($produtos)) {
									foreach($produtos as $produto) {

							?>
							<!-- product -->
							<div class="col-md-4 col-xs-6">
								<div class="product">
									<div class="product-img">
										<img src="<?=$ecommerce->buscar('produto_galeria', 'img_link', ['prod_id' => $produto['prod_id']])[0]['img_link']?>" alt="" height="250px;" style="object-fit: contain; object-position: 50% 50%;">
										<div class="product-label">
											<?php if(!empty($produto['prod_dscnt'])) { ?><span class="sale">-<?=$produto['prod_dscnt']?>%</span><?php } ?>
										</div>
									</div>
									<div class="product-body">
										<p class="product-category"><?=rtrim($produto['cat_nome'], 'es')?></p>
										<h3 class="product-name">
											<a href="#">
												<?php

													$max_name_length = 35;

													if(strlen($produto['prod_nome']) < $max_name_length) {
														echo $produto['prod_nome'];
													} else {
														echo substr($produto['prod_nome'], 0, $max_name_length)."...";
													}

												?>
											</a>
										</h3>
										<h4 class="product-price">R$<?php if(empty($produto['prod_dscnt'])) { echo $produto['prod_preco']; } else { echo round($produto['prod_preco'] - ($produto['prod_preco'] * ($produto['prod_dscnt'] * 0.01)), 2).' <del class="product-old-price">R$'. $produto['prod_preco'] .'</del>'; } ?></h4>
										<div class="product-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
										<div class="product-btns">
											<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
											<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
											<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
										</div>
									</div>
									<div class="add-to-cart">
										<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
									</div>
								</div>
							</div>
							<!-- /product -->
							<?php } } else { echo "<p style='text-align: center; margin-top: 150px; margin-bottom: 750px;'>Parece que nenhum resultado foi encontrado.</p>"; } ?>
						</div>
						<!-- /store products -->

					</div>
					<!-- /STORE -->
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