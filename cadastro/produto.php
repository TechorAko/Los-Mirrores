<?php

require_once "../bibliotecas/mysqli.bli";
require_once "../bibliotecas/conecta_mysqli.inc";
require_once "../bibliotecas/ver_session.inc";

if(isset($_POST["enviar"])) {
    $tabela = "produto";
    $valores = [
        "Nome" => $_POST["nome"],
        "Preco" => $_POST["preco"],
        "Desconto" => $_POST["desconto"],
        "Desc" => $_POST["desc"],
        "Qtde" => $_POST["qtde"],
        "Imagem" => $_POST["imagem"],
        "cat_id" => $_POST["cat_id"],
      
      
    ];
    if($ecommerce->inserir($tabela, $valores)) {
        echo "Funcionou";
    } else { echo "Não funcionou"; }
}

?>

<html>
    <head>
        <title>Área Administrativa</title>
        <link rel="stylesheet" href="../style.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Produto</h1>
        <hr>
        <form action="produto.php" method="POST">
<label> Nome:                       </label> <input type="text" name="nome" placeholder="Digite o nome da produto" maxlength="100" size="20" required>
        <br><label>Preço:                   </label> <input type="number" name="preco" step="0.01" placeholder="1000.00" min="0" max="9999999" required>
        <br><label>Imagem:                  </label> <input type="file" name="Imagem">
        <br><label>Categoria:               </label> <select name="cat_id">
            <?php
                $categorias = $ecommerce->buscar("categoria");
                foreach ($categorias as $index => $categoria) { ?><option value="<?=$categoria["ID"]?>"><?=$categoria["Nome"]?></option><?php }
            ?>
        </select>
        <br><label>Desconto Inicial:        </label> <input type="number" name="desconto" step="1" placeholder="0%" min="0" max="99.9" required>
        <br><label>Quantidade de Estoque:   </label> <input type="number" name="qtde" step="1" placeholder="1000" min="0" max="9999" required>
        <br><label>Descrição:               </label>
        <br><textarea cols=100 rows=5 placeholder="Descreva o seu produto com detalhes." name="desc"></textarea><br>     
            <br><input type="submit" name="enviar" value="Enviar">
        </form>
        <br><a href="../">Voltar</a>
    </body>
</html>