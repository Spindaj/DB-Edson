<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Contas - Controle de Despesas</title>
    <link rel="stylesheet" href="estilos_menu.css">
    <link rel="stylesheet" href="estilos_formulario.css">
</head>

<body>
    <!-- <script src="js/pesquisar.js"></script> -->
    <script>
        function pesquisar() {
            // JavaScript código para recuperar o código do cliente
            const selecao = document.getElementById("CodCliente");
            const codigoClienteEntrada = document.getElementById("codigo_cliente");
            const selecionado = selecao.value;

            codigo_cliente.value = selecionado;
        }
    </script>
    <?php
    require "menu.php";
    require "conexao.php";
    echo "<h3>EDITAR - CONTAS </h3>";
    $numero = $_REQUEST["numero"];
    $sql = "SELECT contas.numero, contas.codigocliente, clientes.nome, contas.descricao, contas.valor, contas.data, contas.tipo, contas.situacao FROM contas INNER JOIN clientes ON contas.codigoCliente = clientes.codigo WHERE contas.numero='$numero'";
    $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
    $linha = mysqli_fetch_array($resultado);
    $numero         = $linha["numero"];
    $codigo_cliente = $linha["codigocliente"];
    $nome           = $linha["nome"];
    $descricao      = $linha["descricao"];
    $valor          = $linha["valor"];
    $data           = $linha["data"];
    $tipo           = $linha["tipo"];
    $situacao       = $linha["situacao"];

    echo "<form name='contas' method='post' action=''>";
    echo "<p>";
        echo "<td label='numero'>Número:<label></td>";
        echo "<td><input type='text' name='numero' value=$numero size='4' readonly></td>";
    echo "</p>";
    echo "<p>";
        echo "<label for='CodCliente'>Cliente:</label>";
        echo "<select name='CodCliente' id='CodCliente' onchange='pesquisar();'>";
        echo "<option>$nome<option>";
        $pesquisa = "SELECT * FROM clientes ORDER BY nome";
        $sql = mysqli_query($conexao, $pesquisa) or die(mysqli_error($conexao));
        
        while ($campo = mysqli_fetch_row($sql)) {
            echo "<option value=$campo[0]> $campo[1]</option> ";
        };
        ?>
        </select>
    <?php
    echo "<input type='hidden' name='codigo_cliente' id='codigo_cliente' size='5' maxlength='5' required>";
    echo "<p>";
        echo "<td label='descricao'>Descrição:<label></td>";
        echo "<td><input type='text' name='descricao' value=$descricao size='100' maxlength='200'></td>";
    echo "</p>";
    echo "<p>";
        echo "<td label='valor'>Valor:<label></td>";
        echo "<td><input type='text' name='valor' value=$valor size='10' maxlength='10'></td>";
    echo "</p>";
    echo "<p>";
        echo "<td label='data'>Data:<label></td>";
        echo "<td><input type='date' name='data' value=$data></td>";
    echo "</p>";
    echo "<p>";
        echo "<td label='tipo'>Tipo:<label></td>";
        echo "<td><input type='text' name='tipo' value=$tipo size='10' maxlength='20'></td>";
    echo "</p>";
    echo "<p>";
        echo "<td label='situacao'>Situação:<label></td>";
        echo "<td><input type='text' name='situacao' value=$situacao size='1' maxlength='1'></td>";
    echo "<p>";
        echo "<td colspan='2'>";
        echo "<input type='submit' name='salvar' value='Salvar'>";
    echo "</td>";
    echo "</p>";
    echo "</table>";
    echo "</form>";
    
    if(isset($_POST["salvar"]))
{
    $numero         = $_POST["numero"];
    $codigo_cliente = $_POST["codigo_cliente"];
    $descricao      = $_POST["descricao"];
    $valor          = $_POST["valor"];
    $data           = $_POST["data"];
    $tipo           = $_POST["tipo"];
    $situacao       = $_POST["situacao"];

    require "conexao.php";
    $sql="UPDATE contas SET codigocliente='$codigo_cliente',";
    $sql.= " descricao='$descricao',";
    $sql.= " valor='$valor',";
    $sql.= " data='$data',";
    $sql.= " tipo='$tipo',";
    $sql.= " situacao='$situacao'";
    $sql.= " WHERE numero='$numero'";
    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
    echo "Conta alterada com sucesso!";
    echo "<meta http-equiv='refresh' content='4;url=contas_pesquisar.php'>";
}
?>
</body>

</html>