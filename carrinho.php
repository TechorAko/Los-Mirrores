<?php
    require_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/bli/load_front";

	if(isset($_POST['removecarrinho'])) {
		$carrinho = isset($_COOKIE['carrinho']) ? unserialize($_COOKIE['carrinho']) : array();
        unset($carrinho[$_POST['removecarrinho']]);
        setcookie('carrinho', serialize($carrinho), time() + 86400);
        header('Location: '. $_SERVER['PHP_SELF']);
        die();
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Carrinho - Los Mirrores</title>
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

					<div class="col-md-7 order-details text-center">
						<div class="cart-list">
							<?php
								if(isset($_COOKIE['carrinho'])) {
									foreach(unserialize($_COOKIE['carrinho']) as $produto => $qtde) {
										$produto = $ecommerce->buscar('produto', '*', ['prod_id' => $produto])[0];
							?>
							<div class="product-widget">
								<div class="product-img">
									<img src="<?=$ecommerce->buscar('produto_galeria', 'img_link', ['prod_id' => $produto['prod_id']])[0]['img_link']?>" alt="">
								</div>
								<div class="product-body">
									<h3 class="product-name">
										<a href="http://<?=$_SERVER['SERVER_NAME']?>/Los-Mirrores/produto.php?p=<?=$produto['prod_id']?>">
											<?php

												$max_name_length = 30;

												if(strlen($produto['prod_nome']) < $max_name_length) {
													echo $produto['prod_nome'];
												} else {
													echo substr($produto['prod_nome'], 0, $max_name_length)."...";
												}

											?>
										</a>
									</h3>
									<h4 class="product-price"><span class="qty"><?=$qtde?>x</span>R$ <?php if(empty($produto['prod_dscnt'])) { echo $produto["prod_preco"] * $qtde; } else { echo round($produto['prod_preco'] - ($produto['prod_preco'] * ($produto['prod_dscnt'] * 0.01)), 2) * $qtde; }?></h4>
								</div>
								<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
									<button class="delete" name="removecarrinho" value="<?=$produto['prod_id']?>"><i class="fa fa-close"></i></button>
								</form>
							</div>
							<?php } } else { echo "Você ainda não adicionou nenhum produto."; } ?>
						</div>
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Seu pedido</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>Produtos</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<div class="order-products">
								<?php
									$total = 0;
									if(isset($_COOKIE['carrinho'])) {
										foreach(unserialize($_COOKIE['carrinho']) as $produto => $qtde) {
											$produto = $ecommerce->buscar('produto', '*', ['prod_id' => $produto])[0];
								?>
									<div class="order-col">
										<div>
											<?=$qtde?>x
											<a href="http://<?=$_SERVER['SERVER_NAME']?>/Los-Mirrores/produto.php?p=<?=$produto['prod_id']?>">
												<?php

													$max_name_length = 30;

													if(strlen($produto['prod_nome']) < $max_name_length) {
														echo $produto['prod_nome'];
													} else {
														echo substr($produto['prod_nome'], 0, $max_name_length)."...";
													}

												?>
											</a>
										</div>
										<div>
											R$
											<?php
												$preco = empty($produto['prod_dscnt']) ? $produto["prod_preco"] * $qtde : round($produto['prod_preco'] - ($produto['prod_preco'] * ($produto['prod_dscnt'] * 0.01)), 2) * $qtde;
												$total += $preco;
												echo $preco;
											?>
										</div>
									</div>
								<?php } } else { ?>
									<div class="order-col text-center">
										Você não adicionou nenhum produto ainda.
									</div>
								<?php } ?>
							</div>
							<div class="order-col">
								<div>Frete</div>
								<div><strong>GRÁTIS</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total">R$ <?=$total?></strong></div>
							</div>
						</div>
						<a href="http://<?=$_SERVER['SERVER_NAME']?>/Los-Mirrores/pedido.php" class="primary-btn order-submit">Fazer o pedido</a>
					</div>
					<!-- /Order Details -->
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
