<html>
    <head>
        <meta http-equiv="Content-Type" content="Text/html; charset=utf-8">
        <title>Alteração de Cadastro</title>
        <link rel="stylesheet" href="../home.css">
    </head>
    <body>
        <?php

            $editmode = $_POST['editmode'];

            $cod_produto        = $_POST['cod_produto'];
            $nome_produto       = $_POST['nome_produto'];
            $categoria_produto  = $_POST['categoria_produto'];
            $img_produto        = $_POST['img_produto'];
            $preco_produto      = $_POST['preco_produto'];
            $desc_produto       = $_POST['desc_produto'];

            if ($editmode == 'Alterar') {
                ?>
                    <form method="POST" action="alterar.php">
                        Nome do Produto: <input type="text" size="25" maxlength="50" name="nome_produto" value="<?=$nome_produto?>" required/><br>
                        <label for="categoria_produto">Categoria do Produto:</label>
                        <select name="categoria_produto" required>
                            <!-- <optgroup> -->
                            <option value="computador">Computador</option>
                            <option value="rede">Rede</option>
                            <option value="hardware">Hardware</option>
                            <option value="gamer">Gamer</option>
                            <option value="escritorio">Escritório</option>
                            <option value="console">Console</option>
                            <option value="acessorios">Acessórios</option>
                        </select><br>
                        Imagem do Produto: <input type="text" size="25" maxlength="2048" name="img_produto" value="<?=$img_produto?>" required><br>
                        Preço do Produto: R$<input type="number" name="preco_produto" placeholder="00.00" size="6" min="0.01" max="1000000" step="0.01" value="<?=$preco_produto?>" required><br>
                        <input type="hidden" name="cod_produto" value="<?=$cod_produto?>"/><br>
                        Descrição do Produto:
                        <br><textarea rows="10" cols="50" maxlength="200" placeholder="Insira uma descrição aqui" name="desc_produto" required><?=$desc_produto?></textarea><br>
                        <input type="submit" value="Alterar Cadastro" name="enviar">
                    </form>
                <?php
            }
            else if ($editmode == 'Eliminar') {
                include '../conecta_mysql.inc';

                $sql = "DELETE FROM produtos WHERE cod_produto='$cod_produto'";
                if($con->query($sql) === TRUE) {
                    echo "Produto excluido com sucesso excluído com sucesso<br>";
                    echo "<button><a href='../home.html'>Voltar</a></button>";
                }
                else {
                    echo "Erro: ". $sql . "<br>" . $con->error;
                    echo "<button><a href='../home.html'>Voltar</a></button>";
                }
                $con->close();

            }

        ?>
    </body>
</html>