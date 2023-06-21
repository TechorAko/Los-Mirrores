<?php
    require_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/bli/load_front";
	require_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/bli/ver_session";

	if(isset($_POST['pedido'])) {
		$endereco = ["end_estado" => $_POST['estado'], "end_cidade" => $_POST['cidade'], "end_cep" => $_POST['cep'], "end_num" => $_POST['num'], "user_id" => $_SESSION['user_id']];
		$ecommerce->inserir('endereco', $endereco);
		$end_id = $ecommerce->insert_id;
		
		$pedido = ["ped_pag" => $_POST['pagamento'], "user_id" => $_SESSION['user_id'], "end_id" => $end_id];
		$ecommerce->inserir('pedido', $pedido);
		$ped_id = $ecommerce->insert_id;

		$total = 0;

		foreach(unserialize($_COOKIE['carrinho']) as $produto => $qtde) {
			$carrinho = ['prod_id' => $produto, 'car_qtde' => $qtde, 'ped_id' => $ped_id];
			$ecommerce->inserir('carrinho', $carrinho);
			$total += $ecommerce->buscar("produto", "prod_preco", ["prod_id" => $produto])[0]["prod_preco"] * $qtde;
		}

		$ecommerce->alterar("pedido", ["ped_total" => $total], ["ped_id" => $ped_id]);
		unset($_COOKIE['carrinho']);
		setcookie("carrinho", "", time() - 3600);
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Pedido - Los Mirrores</title>
		<?php include_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/bli/bootstrap/"; ?>
    </head>
	<body>
		<?php include_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/header.php"; ?>

		<?php if(!isset($_POST['pedido'])) { ?>

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
						<div class="col-md-7">
							<!-- Billing Details -->
							<div class="billing-details">
								<div class="section-title">
									<h3 class="title">Endereço</h3>
								</div>
								<div class="form-group">
									<select class="input input-select" name="estado" required>
										<option>Escolher um estado</option>
										<?php

											$estados = [
												"Acre",
												"Alagoas",
												"Amapá",
												"Amazonas",
												"Bahia",
												"Ceará",
												"Distrito Federal",
												"Espírito Santo",
												"Goiás",
												"Maranhão",
												"Mato Grosso",
												"Mato Grosso do Sul",
												"Minas Gerais",
												"Pará",
												"Paraíba",
												"Paraná",
												"Pernambuco",
												"Piauí",
												"Rio de Janeiro",
												"Rio Grande do Norte",
												"Rio Grande do Sul",
												"Rondônia",
												"Roraima",
												"Santa Catarina",
												"São Paulo",
												"Sergipe",
												"Tocantins",
											];

											foreach($estados as $estado) {
												?><option value="<?=$estado?>"><?=$estado?></option><?php
											}

										?>
									</select>
								</div>
								<div class="form-group">
									<input class="input" type="text" name="cidade" placeholder="Cidade" required>
								</div>
								<div class="form-group">
									<input class="input" type="text" name="cep" placeholder="CEP" required>
								</div>
								<div class="form-group">
									<input class="input" type="text" name="num" placeholder="Número de Residência" required>
								</div>
							</div>
							<!-- /Billing Details -->
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
								<div class="payment-method">
								<div class="input-radio">
									<input type="radio" name="pagamento" value="Cartão de Crédito" id="payment-1">
									<label for="payment-1">
										<span></span>
										Cartão de Crédito
									</label>
								</div>
								<div class="input-radio">
									<input type="radio" name="pagamento" value="Boleto" id="payment-2">
									<label for="payment-2">
										<span></span>
										Boleto
									</label>
								</div>
								<div class="input-radio">
									<input type="radio" name="pagamento" value="Pix" id="payment-3">
									<label for="payment-3">
										<span></span>
										Pix
									</label>
								</div>
							</div>
							</div>
							<button type="submit" name="pedido" class="primary-btn order-submit">Terminar o pedido</a>
						</div>
						<!-- /Order Details -->
					</form>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<?php } else { ?>

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row text-center">
					<h1>Pedido feito com sucesso.</h1>
					<a href="http://<?=$_SERVER['SERVER_NAME']?>/Los-Mirrores/" class="primary-btn">Voltar</a>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<?php } ?>

		<?php include_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/footer.php" ?>

		<?php include_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/bli/bootstrap/jquery_plugins.php"; ?>

	</body>
</html>
