<?php
    require_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/bli/load_front";

	if(!isset($_GET["p"])) { header('Location: http://' . $_SERVER['SERVER_NAME'] . '/Los-Mirrores/'); die(); }

	$produto = is_array($ecommerce->buscar('produto', '*', ['prod_id' => $_GET['p']])) ? $ecommerce->buscar('produto', '*', ['prod_id' => $_GET['p']])[0] : NULL;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php if(is_array($produto)) { echo $produto['prod_nome'] . ' - Los Mirrores'; } else { echo 'Produto não encontrado - Los Mirrores'; } ?></title>
		<?php
			include_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/bli/bootstrap/"; 
			include_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/header.php";
		?>
    </head>
	<body>
		
		<?php include_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/header.php"; ?>

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="#">Produtos</a></li>
							<li><a href="#">Todas as Categorias</a></li>
							<?php if(!empty($produto)) { ?>
								<li><a href="#"><?=$ecommerce->buscar('categoria', 'cat_nome', ['cat_id' => $produto['cat_id']])[0]['cat_nome']?></a></li>
								<li class="active">
								<?php

									$max_name_length = 100;

									if(strlen($produto['prod_nome']) < $max_name_length) {
										echo $produto['prod_nome'];
									} else {
										echo substr($produto['prod_nome'], 0, $max_name_length)."...";
									}

								?>
								</li>
							<?php } else { ?><li><a href="#">Não encontrado</a></li><?php } ?>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<?php $produto_galeria = is_array($ecommerce->buscar('produto_galeria', 'img_link', ['prod_id' => $_GET['p']])) ? $ecommerce->buscar('produto_galeria', 'img_link', ['prod_id' => $_GET['p']]) : NULL ?>
					<!-- Product main img -->
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">
						<?php if(is_array($produto)) { foreach($produto_galeria as $imagem) { ?>
							<div class="product-preview">
								<img src="<?=$imagem['img_link']?>" alt="Imagem do produto" height="500px" style="object-fit: contain; object-position: 50% 50%;">
							</div>
						<?php } } ?>
						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
							<?php if(is_array($produto)) { foreach($produto_galeria as $imagem) { ?>
								<div class="product-preview">
									<img src="<?=$imagem['img_link']?>" alt="Imagem do produto" height="125px" style="object-fit: contain; object-position: 50% 50%;">
								</div>
							<?php } } ?>
						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name"><?=$produto['prod_nome']?></h2>
							<div>
								<h3 class="product-price">R$<?php if(empty($produto['prod_dscnt'])) { echo $produto['prod_preco']; } else { echo round($produto['prod_preco'] - ($produto['prod_preco'] * ($produto['prod_dscnt'] * 0.01)), 2).' <del class="product-old-price">R$'. $produto['prod_preco'] .'</del>'; } ?></del></h3>
								<span class="product-available"><?php if($produto['prod_qtde'] > 0) { echo "Em estoque"; } else { echo 'Fora de estoque'; } ?></span>
							</div>
							<p><?=$produto['prod_desc']?></p>

							<div class="add-to-cart">
								<form action="<?="http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/produto.php?p=" . $produto['prod_id']?>" action="POST">
									<div class="row">
										<div class="qty-label">
											Quantidade: 
											<div class="input-number">
												<input type="number" name="qtde" value="1" min="1" max="<?=$produto['prod_qtde']?>">
												<span class="qty-up">+</span>
												<span class="qty-down">-</span>
											</div>
										</div>
									</div>
									<div class="row text-center" style="margin-top: 25px;">
										<button class="add-to-cart-btn" type="submit" name="addcarrinho" value="<?=$produto['prod_id']?>"><i class="fa fa-shopping-cart"></i>Adicionar ao carrinho</button>
									</div>
								</form>
							</div>

							<ul class="product-links">
								<li>Categorias:</li>
								<?php
									$categorias = is_array($ecommerce->buscar('produto_filtro, filtro, categoria', 'categoria.cat_id, cat_nome', ['produto_filtro.fltr_id' => 'filtro.fltr_id', 'filtro.cat_id' => 'categoria.cat_id', 'produto_filtro.prod_id' => $_GET['p']], FALSE, ['cat_nome' => 'ASC'])) ? $ecommerce->buscar('produto_filtro, filtro, categoria', 'categoria.cat_id, cat_nome', ['produto_filtro.fltr_id' => 'filtro.fltr_id', 'filtro.cat_id' => 'categoria.cat_id', 'produto_filtro.prod_id' => $_GET['p']], FALSE, ['cat_nome' => 'ASC']) : $ecommerce->buscar('categoria', 'categoria.cat_id, cat_nome', ['cat_id' => $produto['cat_id']]);

									if(is_array($produto)) { foreach($categorias as $categoria) { if($categoria['cat_nome'] == 'Marcas') { continue; } ?>
										<li><a href="#"><?=$categoria['cat_nome']?></a></li>
								<?php } }  ?>
							</ul>

						</div>
					</div>
					<!-- /Product details -->


				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- Section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Produtos Relacionados</h3>
						</div>
					</div>

					<?php

						$relacionados = $ecommerce->fetch_multiarray("SELECT cat_nome, prod_id, prod_nome, prod_preco, prod_dscnt, prod_criado FROM categoria, produto WHERE produto.cat_id = categoria.cat_id ORDER BY prod_criado DESC LIMIT 4", MYSQLI_ASSOC);
						foreach($relacionados as $produto) {

					?>
					<!-- product -->
					<div class="col-md-3 col-xs-6">
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
								<form action="<?="http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/produto.php?p=" . $produto['prod_id']?>" method="POST">
									<button class="add-to-cart-btn" style="padding: 10px; padding-top: 8px;" type="submit" name="addcarrinho" value="<?=$produto['prod_id']?>">Adicionar ao carrinho</button>
								</form>
							</div>
						</div>
					</div>
					<!-- /product -->

					<div class="clearfix visible-sm visible-xs"></div>

					<?php } ?>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->

		<?php include_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/footer.php" ?>

		<?php include_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/bli/bootstrap/jquery_plugins.php"; ?>

	</body>
</html>
