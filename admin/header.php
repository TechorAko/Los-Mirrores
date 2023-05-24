<?php

    $path .= "/admin";
    
    if(!isset($_SESSION["user_id"])) {
?>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top justify-content-center">
        <a class="navbar-brand" href="<?=$path?>">Los Mirrores</a>
    </nav>
<?php } else { ?>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top">

        <!-- Brand -->
        <a class="navbar-brand" href="<?=$path?>">Los Mirrores</a>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?=$path?>">Inicio</a>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="<?=$_SERVER['PHP_SELF']?>" id="navbardrop" data-toggle="dropdown">
                        Gerenciar
                    </a>
                    <div class="dropdown-menu">
                        <?php
                            $gerenciar = [
                                "Avaliações" => "avaliacoes/",
                                "Clientes" => "clientes/",
                                "Funcionários" => "funcionarios/",
                                "Pedidos" => "pedidos/",
                                "Produtos" => "produtos/",
                                "Usuários" => "usuarios/",
                            ];
                            
                            foreach($gerenciar as $tabela => $link) {
                                ?><a class="dropdown-item" href="<?=$path."/gerenciar/".$link?>"><?=$tabela?></a><?php
                            }
                        ?>
                    </div>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        <i class="far fa-user mr-2 tm-logout-icon"></i>Perfil
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?=$path?>/perfil">Ver Perfil</a>
                        <a class="dropdown-item" href="<?=$path?>/login/?sair=0">Sair</a>
                    </div>
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