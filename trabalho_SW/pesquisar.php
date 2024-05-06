<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Despesas - Pesquisa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1>FORNECEDOR</h1>
        <nav>
            <a href="editar.html">Editar</a>
            <a href="inserir.html">Inserir</a>
            <a href="pesquisar.html">Pesquisar</a>
        </nav>
    </header>

    <?php
        echo "<h3>LISTAGEM DOS FORNECEDORES</h3>";
        require "conexao.php";

        $sql = "SELECT * FROM TBFornecedor ORDER BY nome";
        $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

        echo "<table class='table'>";
            echo "<tr>";
                echo "<th width='100' align='right'>IDFornecedor</th>";
                echo "<th width='300' align='Left'>Nome</th>";
                echo "<th width='100' align='Left'>Cidade</th>";
                echo "<th width='250' align='Left'>CNPJ</th>";
                echo "<th width='50' align='Left'>Editar</th>";
            echo "</tr>";

            while ($linha=mysqli_fetch_array($resultado)) {
                $idfornecedor = $linha["idfornecedor"];
                $nome = $linha["nome"];
                $cidade = $linha["cidade"];
                $cnpj = $linha["cnpj"];

                echo "<tr>";
                    echo "<th width='100' align='right'>$idfornecedor</th>";
                    echo "<th width='300' align='Left'>$nome</th>";
                    echo "<th width='100' align='Left'>$cidade</th>";
                    echo "<th width='250' align='Left'>$cnpj</th>";
                    echo "<th width='50' align='center'><a href='editar.php?codigo=$idfornecedor'>Editar</a></th>";
                echo "</tr>";
            }
        echo "</table>";
    ?>
</body>
</html>