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
            <div class="col-md-4">
                <div class="header-logo">
                    <a href="http://<?=$_SERVER['SERVER_NAME']?>/Los-Mirrores/" class="logo">
                        <img src="http://<?=$_SERVER['SERVER_NAME']?>/Los-Mirrores/assets/media/losmirrores_brand.png" alt="" width="250px" style="margin-top: 7px">
                    </a>
                </div>
            </div>
            <!-- /LOGO -->

            <!-- SEARCH BAR -->
            <div class="col-md-5">
                <div class="header-search">
              
                    <form action="http://<?=$_SERVER['SERVER_NAME']?>/Los-Mirrores/pesquisa.php" method="GET">
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
    <a class="dropdown-toggle" href="http://<?=$_SERVER['SERVER_NAME']?>/Los-Mirrores/carrinho.php">
        <i class="fa fa-shopping-cart"></i>
        <span>Carrinho</span>
        <?php if(isset($_COOKIE['carrinho'])) {?> <div class="qty"><?=count(unserialize($_COOKIE['carrinho']))?></div> <?php } ?>
    </a>
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