<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa do Controle de Despesas</title>
    <link rel="stylesheet" href="estilos_menu.css">
</head>
<body>
<?php
        require "menu.php";
        echo "<h3>Controle de Despesas - Pesquisa</h3>";
        require "conexao.php";
        $sql = "SELECT contas.numero, contas.codigoCliente, clientes.nome, contas.descricao, contas.valor, contas.data, contas.tipo, contas.situacao FROM contas INNER JOIN clientes ON contas.codigoCliente = clientes.codigo ORDER BY data";
        $resultado=mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
        echo "<table border=1 width=800>";
            echo "<tr>";
                echo "<th>Número</th>";
                echo "<th>Nome</th>";
                echo "<th>Descrição</th>";
                echo "<th>Valor</th>";
                echo "<th>Data</th>";
                echo "<th>Tipo</th>";
                echo "<th>Editar</th>";
            echo "</tr>";
            while($linha=mysqli_fetch_array($resultado))
            {
                $numero     = $linha["numero"];
                $nome       = $linha["nome"];
                $descricao  = $linha["descricao"];
                $valor      = $linha["valor"];
                $data       = $linha["data"];
                $tipo       = $linha["tipo"];

                // Exibindo os dados
                echo "<tr>";
                    echo "<td width=100 align='right'>$numero</td>";
                    echo "<td width=200 align='left'>$nome</td>";
                    echo "<td width=200 align='left'>$descricao</td>";
                    $ValorFormatado = number_format($valor,2,",",".");
                    echo "<td width=130 align='right'>$ValorFormatado</td>";
                    $Data_Formato_Brasil = substr($data, 8,2) . "/" . substr($data, 5,2) . "/" . substr($data, 0,4) ;
                    echo "<td width=130 align='right'>$Data_Formato_Brasil</td>";
                    echo "<td width=130 align='left'>$tipo</td>";
                    echo "<td><a href='contas_editar.php?numero=$numero'>Editar</td>";
                echo "</tr>";
            }
        echo "</table>";
    ?>

</body>
</html>