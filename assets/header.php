<?php
    require_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/bli/load_front";
?>
<header class="sticky-top">

<!-- MAIN HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class="col-md-3">
                <div class="header-logo">
                    <a href="http://<?=$_SERVER['SERVER_NAME']?>/Los-Mirrores/" class="logo">
                        <img src="http://<?=$_SERVER['SERVER_NAME']?>/Los-Mirrores/assets/bli/bootstrap/img/logo.png" alt="">
                    </a>
                </div>
            </div>
            <!-- /LOGO -->

            <!-- SEARCH BAR -->
            <div class="col-md-6">
                <div class="header-search">
              
                    <form action="http://<?=$_SERVER['SERVER_NAME']?>/Los-Mirrores/store.php" method="GET">
                        <div class="input-group">
                            <select class="input-select" name="c[]">
                                <option value="">Categoria</option>
                            <?php
                                $cats = $ecommerce->fetch_multiarray("SELECT cat_id, cat_nome FROM categoria", MYSQLI_ASSOC);
                                foreach($cats as $cat) { ?> <option value="<?=$cat["cat_id"]?>"><?=$cat["cat_nome"]?></option> <?php } ?>
                            </select>
                            <input class="input" placeholder="Pesquise aqui" name="s">
                            <button class="search-btn">Buscar</button>
                        </div>
					</form>
				</div>
			</div>
            <!-- /SEARCH BAR -->

            <!-- ACCOUNT -->
            <div class="col-md-3 clearfix">
                <div class="header-ctn">
                <?php
$carrin = $ecommerce->fetch_multiarray("SELECT carrinho.prod_id, produto.prod_id, prod_nome, car_qtde, prod_preco FROM carrinho, produto WHERE produto.prod_id = carrinho.prod_id", MYSQLI_ASSOC);
$subtotal = 0;
?>
<style>
    .cart-dropdown {
        max-height: 300px; 
        overflow-y: auto;
        overflow-x: hidden;
    }
    .cart-summary{
        position:sticky;
        bottom:0;
        background: white; 
    }
</style>
<!-- Cart -->
<div class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <i class="fa fa-shopping-cart"></i>
        <span>Carrinho</span>
        <div class="qty"><?= count($carrin) ?></div>
    </a>
    <div class="dropdown-menu dropdown-menu-right cart-dropdown" aria-labelledby="cartDropdown">
        <?php
        foreach ($carrin as $car) {
            $subtotal += $car["car_qtde"] * $car["prod_preco"];
        ?>
            <div class="dropdown-item cart-item">
                <div class="product-widget">
                    <div class="product-img">
                        <img src="./img/product01.png" alt="">
                    </div>
                    <div class="product-body">
                        <h3 class="product-name"><a href="#"><?= $car["prod_nome"] ?></a></h3>
                        <h4 class="product-price"><span class="qty"><?= $car["car_qtde"] ?>x</span>$980.00</h4>
                    </div>
                    <button class="btn btn-link btn-delete"><i class="fa fa-close"></i></button>
                </div>
            </div>
        <?php } ?>
        <div class="cart-summary" >
            <small><?= count($carrin) ?> Item(s) selected</small>
            <h5 class="subtotal">SUBTOTAL: R$<?= number_format($subtotal, 2) ?></h5>
      
            <div class="d-flex justify-content-between input-group">
            <a href="#" class="btn btn-primary">Ver Carrinho</a>
            <a href="#" class="btn btn-success">Finalizar Compra <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div></div>
    
</div>
<!-- /Cart -->

<!-- /Cart -->

                    <!-- /Cart -->

                    <!-- Profile -->
                    <div>
                        <a href="#">
                            <i class="fa fa-user-o"></i>
                            <span>Perfil</span>
                        </a>
                    </div>
                    <!-- /Profile -->

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
						<li><a href="#">Categories</a></li>
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