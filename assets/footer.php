<?php
    require_once "http://" . $_SERVER['SERVER_NAME'] . "/Los-Mirrores/assets/bli/load_front";
?>
<!-- FOOTER -->
<footer id="footer">
<!-- top footer -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-4 col-xs-6">
                <div class="footer">
                    <h3 class="footer-title">Sobre</h3>
                    <p>Nós somos um grupo de trabalho da disciplina de Tecnologias para Desenvolvimento de Sistemas e este, é o nosso projeto com a temática de e-commerce.</p>
                    <ul class="footer-links">
                        <li><a href="https://github.com/TechorAko/Los-Mirrores" target="_blank"><i class="fa fa-map-marker"></i>Github</a></li>
                        <li><a href="https://wa.me/553299770841" target="_blank"><i class="fa fa-phone"></i>Whatsapp</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4 col-xs-6">
                <div class="footer">
                    <h3 class="footer-title">Categorias</h3>
                    <ul class="footer-links">
                        <?php foreach($ecommerce->buscar('categoria', 'cat_id, cat_nome') as $categoria) { ?>
                            <li><a href="#"><?=$categoria['cat_nome']?></a></li>
                        <?php }?>
                    </ul>
                </div>
            </div>

            <div class="clearfix visible-xs"></div>


            <div class="col-md-4 col-xs-6">
                <div class="footer">
                    <h3 class="footer-title">Serviços</h3>
                    <ul class="footer-links">
                        <li><a href="#">Minha conta</a></li>
                        <li><a href="#">Ver carrinho</a></li>
                        <li><a href="#">Meus pedidos</a></li>
                        <li><a href="#">Categorias</a></li>
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
                    Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
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