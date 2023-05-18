<?php if(!isset($_SESSION["user_id"])) { ?>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top justify-content-center">
        <a class="navbar-brand" href="#">Los Mirrores</a>
    </nav>
<?php } else { ?>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top">

        <!-- Brand -->
        <a class="navbar-brand" href="#">Los Mirrores</a>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link" href="./">Inicio</a>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle disabled" href="#" id="navbardrop" data-toggle="dropdown">
                    Gerenciar
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Avaliações</a>
                    <a class="dropdown-item" href="#">Clientes</a>
                    <a class="dropdown-item" href="#">Funcionários</a>
                    <a class="dropdown-item" href="#">Pedidos</a>
                    <a class="dropdown-item" href="#">Produtos</a>
                </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="login.php?sair=0">Sair</a>
                </li>
            </ul>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

    </nav>
<?php }

    if(isset($alert)) {
        ?>
            <div class="alert alert-<?=$alert["context"]?> alert-dismissible fade show">
                <?=$alert["content"]?>
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        <?php
    }

?>