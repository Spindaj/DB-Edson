<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de contas</title>
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
    ?>
    <h3>Cadastro de contas</h3>
    <form name="contas" method="post" action="">
        <p>
            <label for="CodCliente">Cliente:</label>
            <select name="CodCliente" id="CodCliente" onchange="pesquisar();">
                <?php
                require "conexao.php";
                $pesquisa = "SELECT * FROM clientes ORDER BY nome";
                $sql = mysqli_query($conexao, $pesquisa) or die(mysqli_error($conexao));
                echo "<option><option>";
                while ($campo = mysqli_fetch_row($sql)) {
                    echo "<option value=$campo[0]> $campo[1]</option> ";
                };
                ?>
            </select>

            <!-- <p> </p>-->
            <!-- <label for="codigo_cliente">CodCli:</label> -->
            <input type="hidden" name="codigo_cliente" id="codigo_cliente" size="5" maxlength="5" required>
            <!-- </p>-->
        </p>
        <p>
            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" size="70" maxlength="200" required>
        </p>
        <p>
            <label for="valor">Valor:</label>
            <input type="text" name="valor" required>
        </p>
        <p>
            <label for="data">Data:</label>
            <input type="date" name="data" required>
        </p>
        <p>
            <label for="tipo">Tipo: *</label>
            <br />
            <label>
                <input type="radio" name="tipo[]" value="Fixa" id="tipo_0" />
                Fixa</label>
            <br />
            <label>
                <input type="radio" name="tipo[]" value="Variável" id="tipo_1" />
                Variável</label>
            <br />
        </p>
        <input type="submit" name="inserir" value="Inserir">
        <p>
    </form>
    <?php
    if (isset($_POST["inserir"])) {
        $codigo_cliente   = $_POST["codigo_cliente"];
        $descricao         =  $_POST["descricao"];
        $valor             =  $_POST["valor"];
        $data              =  $_POST["data"];
        $tipo              =  $_POST["tipo"];

        $valores = '';
        if (isset($_POST["tipo"])) {
            $tipo                =    $_POST["tipo"];
            foreach ($tipo as $k => $v) {
                $valores .= $v . " ";
            }
        } else {
            $mensagem .= "Você não informou a Área de Atuação<br>";
            $erros++;
        }
        require "conexao.php";
        $sql = "INSERT INTO contas(numero,descricao, CodigoCliente, valor, data, tipo, situacao)";
        $sql .= " Values(null, '$descricao','$codigo_cliente', '$valor', '$data', '$valores','A')";
        mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
        echo "<p>Conta  inserida com sucesso!</p>";
        echo "<meta http-equiv='refresh' content='4;url=contas_pesquisar.php'>";
    }
    ?>
</body>

</html>