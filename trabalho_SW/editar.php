<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Despesas - Editar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        echo "<h3>Editar Cadastro de Clientes</h3>";
        
        require "conexao.php";
        $idfornecedor = $_REQUEST["idfornecedor"];
        $sql = "SELECT * FROM TBFornecedor WHERE idfornecedor='$idfornecedor'";
        $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
        $linha = mysqli_fetch_array($resultado);

        $idfornecedor = $linha["idfornecedor"];
        $nome = $linha["nome"];
        $cidade = $linha["cidade"];
        $cnpj = $linha["cnpj"];
        $situacao = $linha["situacao"];

        echo "<form name='cadastro' method='post' action=''>";
            echo "<table align='center'>";
                echo "<tr>";
                    echo "<td><label for='codigo'>Código:</label></td>";
                    echo "<td><input type='text' name='codigo' size='4' value='$idfornecedor' readonly></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td><label for='nome'>Nome:</label></td>";
                    echo "<td><input type='text' name='nome' size='50' maxlegth='50' value='$nome' required></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td><label for='cidade'>Cidade:</label></td>";
                    echo "<td><input type='text' name='cidade' size='30' maxlegth='30' value='$cidade' required></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td><label for='cpf'>CPF:</label></td>";
                    echo "<td><input type='text' name='cnpj' size='14' maxlegth='14' value='$cnpj' required></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td colspan='2' align='center'><input type='submit' name='salvar' value='Salvar'></td>";
                echo "</tr>";
            echo "</table>";
        echo "</form>";

        if (isset($_POST["salvar"])) {
            $nome = $_POST["nome"];
            $cidade = $_POST["cidade"];
            $cnpj = $_POST["cnpj"];

            require "conexao.php";
            $sql = "UPDATE clientes SET nome='$nome', cidade='$cidade', cnpj='$cnpj' WHERE idfornecedor='$idfornecedor'";
            mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
            echo "<script type =\"text/javascript\">alert('Fornecedor editado com sucesso!');</script>";
            echo "<p align='center'><a href='#'>Voltar</a></p>";
        }
    ?>
</body>
</html>