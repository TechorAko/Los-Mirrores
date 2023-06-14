<?php

require_once "../bibliotecas/mysqli.bli";
require_once "../bibliotecas/conecta_mysqli.inc";
require_once "../bibliotecas/ver_session.inc";

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
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Electro - HTML Ecommerce Template</title>

 		<!-- Google font -->
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

 		<!-- Bootstrap -->
 		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

 		<!-- Slick -->
 		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
 		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

 		<!-- nouislider -->
 		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

 		<!-- Font Awesome Icon -->
 		<link rel="stylesheet" href="css/font-awesome.min.css">

 		<!-- Custom stlylesheet -->
 		<link type="text/css" rel="stylesheet" href="css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>
						<li><a href="#"><i class="fa fa-user-o"></i> My Account</a></li>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<img src="./img/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select">
										<option value="0">All Categories</option>
										<option value="1">Category 01</option>
										<option value="1">Category 02</option>
									</select>
									<input class="input" placeholder="Search here">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">2</div>
									</a>
								</div>
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty">3</div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product01.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>

											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product02.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>
										</div>
										<div class="cart-summary">
											<small>3 Item(s) selected</small>
											<h5>SUBTOTAL: $2940.00</h5>
										</div>
										<div class="cart-btns">
											<a href="#">View Cart</a>
											<a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="#">Home</a></li>
						<li><a href="#">Hot Deals</a></li>
						<li><a href="#">Categodasdadaries</a></li>
						<li><a href="#">Laptops</a></li>
						<li><a href="#">Smartphones</a></li>
						<li><a href="#">Cameras</a></li>
						<li><a href="#">Accessories</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li><a href="#">All Categories</a></li>
							<li><a href="#">Accessories</a></li>
							<li class="active">Headphones (227,490 Results)</li>
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
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Categorias</h3>
							<div class="checkbox-filter">
							<ul>
                            <?php
    
                                $categorias = $ecommerce->buscar("categoria", "cat_id, cat_nome");
    
                                if(is_array($categorias)) {
                                    foreach($categorias as $categoria) {
                                        ?>
                                            <li><input type="checkbox" name="c[]" value="<?=$categoria["cat_id"]?>" <?php if(isset($_GET["c"])) { check($_GET["c"], $categoria["cat_id"]); }?> onchange="this.form.submit()"> <?=$categoria["cat_nome"]?></li>
                                            <ul>
                                              
                                            </ul>
                                        <?php
                                    }
                                }
                            ?>
                            </ul>
								

		
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Preço</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="input-number price-min">
									<input id="price-min" type="number" name="pmin" <?php if(isset($_GET["pmin"])) { ?>value="<?=$_GET["pmin"]?>"<?php }?>>
									
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number">
									<input id="price-max" type="number" name="pmax" <?php if(isset($_GET["pmax"])) { ?>value="<?=$_GET["pmax"]?>"<?php }?> >
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Marcas</h3>
							<div class="checkbox-filter">
								<div class="checkbox-filter">
									
								
								<ul>
                            <?php
    
                                $categorias = $ecommerce->buscar2("categoria", "cat_id, cat_nome", ["cat_id" => 2]);
    
                                if(is_array($categorias)) {
                                    foreach($categorias as $categoria) {
                                        ?>

                                            <ul>
                                                <?php
                                                    $filtros = $ecommerce->fetch_multiarray("SELECT * FROM filtro WHERE cat_id=2", MYSQLI_ASSOC);
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
								
							</div>
						</div>
						<!-- /aside Widget -->
				
                 
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Mais vendidos</h3>
							<?php
                    $produtos = $ecommerce->fetch_multiarray("SELECT produto.prod_id, prod_nome, prod_preco as total, sum(car_qtde) as qtde FROM carrinho, produto, pedido WHERE produto.prod_id = carrinho.prod_id AND pedido.ped_id = carrinho.ped_id GROUP BY produto.prod_id ORDER BY total DESC LIMIT 4", MYSQLI_ASSOC);
                    if(is_array($produtos)) { foreach($produtos as $produto) {

                                        $imagem = $ecommerce->buscar("produto_galeria", "img_link", ["produto_galeria.prod_id" => $produto["prod_id"]])[0]["img_link"];

             

                                        $categorias = $ecommerce->buscar("categoria, produto", "categoria.cat_nome", ["produto.cat_id" => "categoria.cat_id", "produto.prod_id" => $produto["prod_id"]]);
                                        if(is_array($categorias)) { foreach ($categorias as $categoria) {
                                           
                                       

                                    ?>
                                </td>
                            </tr>
							<div class="product-widget">
								<div class="product-img">
								<img src="../assets/prod_img/<?=substr($imagem, -17)?>" alt="Imagem de exibição do produto"/>
								</div>
								<div class="product-body">
									<p class="product-category"><?=$categoria["cat_nome"]?></p>
									<h3 class="product-name"><a href="#"><?=$produto["prod_nome"]?></a></h3>
									<h4 class="product-price"><?=$produto["total"]?>R$</h4>
								</div>
							</div>
							<?php } }
                    } }
                ?>
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
								Ordenar por: <select name="order" class="input-select" onchange="this.form.submit()">
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
							</label>
								<label>
									Show:
									<select class="input-select">
										<option value="0">20</option>
										<option value="1">50</option>
									</select>
								</label>
							</div>
						</div>
						<!-- /store top filter -->

						<!-- store products -->
						<div class="row">
							<!-- product -->
							<div class="col-md-4 col-xs-6">
								<div class="product">
									<div class="product-img">
										<img src="./img/product01.png" alt="">
										<div class="product-label">
											<span class="sale">-30%</span>
											<span class="new">NEW</span>
										</div>
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
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
						</div>
						<!-- /store products -->

						<!-- store bottom filter -->
						<div class="store-filter clearfix">
							<span class="store-qty">Showing 20-100 products</span>
							<ul class="store-pagination">
								<li class="active">1</li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
							</ul>
						</div>
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Categories</h3>
								<ul class="footer-links">
									<li><a href="#">Hot deals</a></li>
									<li><a href="#">Laptops</a></li>
									<li><a href="#">Smartphones</a></li>
									<li><a href="#">Cameras</a></li>
									<li><a href="#">Accessories</a></li>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Information</h3>
								<ul class="footer-links">
									<li><a href="#">About Us</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Orders and Returns</a></li>
									<li><a href="#">Terms & Conditions</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
									<li><a href="#">My Account</a></li>
									<li><a href="#">View Cart</a></li>
									<li><a href="#">Wishlist</a></li>
									<li><a href="#">Track My Order</a></li>
									<li><a href="#">Help</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>
