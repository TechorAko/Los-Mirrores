
<?php

include "../conecta_mysqli.php";

// Cadastro de informações no banco de dados.
// 
// Deve seguir ESTE PADRÃO.
// 
// $tabela = tbExemplo;
// $atributos = "ex_id, ex_nome, ex_desc, ..."
// $valores = "'1','Joaquim da Silva Pereira','Ele foi muito mal na escola',...)'"
// A ordem dos atributos devem estar na mesma ordem dos valores.

function cadastrar($tabela, $atributos, $valores) {
    include '../conecta_mysqli.php';

    $sql = "INSERT INTO ". $tabela ." (". $atributos .") VALUES (". $valores .")";

    if($con->query($sql) === TRUE) {
        echo "Usuário incluído com sucesso!<br>";
    } else {
        echo "Erro: " . $sql . "<br>" . $con->error;
    }
    $con->close();
};

// Uma busca dentro do banco de dados
// 
// $tabela = tbExemplo;
// $atributos = ["ID", "Nome", "Idade",...];
// $referencia = nome;
// $pesquisa = "Joaquim da Silva Pereira";
//
// A função retornará todos os valores requisitados em um vetor na ordem que foi desejada.

function buscar($tabela, $atributos, $referencia, $pesquisa) {

    include '../conecta_mysqli.php';

    $selecionar = NULL;
    for($k = 0 ; $k < count($atributos)-1 ; $k++) {$selecionar .= $atributos[$k].",";}
    $selecionar .= $atributos[count($atributos)-1];

    $sql = "SELECT $selecionar FROM $tabela WHERE $referencia = '$pesquisa'";
    $select = $con->query($sql);

    if ($select) {
        $array = array();
        while($linha = mysqli_fetch_array($select)) {
            for ($i = 0 ; $i < count($atributos) ; $i++) {
                ${"valor".$i} = $linha[$atributos[$i]];
                array_push($array, ${"valor".$i});
            }
        return $array;
        }
    } else {
        echo "Erro: " . $sql . "<br>" . $conexao->error;
    }
}

?>