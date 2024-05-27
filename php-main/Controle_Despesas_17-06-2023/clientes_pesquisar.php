<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Despesas - Pesquisa</title>
    <link rel="stylesheet" href="estilos_menu.css">
</head>
<body>
    <?php
        require "menu.php";
        echo "<h3>Controle de Despesas - Pesquisa</h3>";
        require "conexao.php";
        $sql = "SELECT * FROM clientes ORDER BY nome";
        $resultado=mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
        echo "<table border=1 width=800>";
            echo "<tr>";
                echo "<th>Código</th>";
                echo "<th>Nome</th>";
                echo "<th>E-mail</th>";
                echo "<th>Telefone</th>";
                echo "<th>Editar</th>";
            echo "</tr>";
            while($linha=mysqli_fetch_array($resultado))
            {
                $codigo = $linha["codigo"];
                $nome   = $linha["nome"];
                $email  = $linha["email"];
                $contato= $linha["contato"];

                // Exibindo os dados
                echo "<tr>";
                    echo "<td width=100 align='right'>$codigo</td>";
                    echo "<td width=200 align='left'>$nome</td>";
                    echo "<td width=200 align='left'>$email</td>";
                    echo "<td width=130 align='left'>$contato</td>";
                    echo "<td><a href='clientes_editar.php?codigo=$codigo'>Editar</td>";
                echo "</tr>";
            }
        echo "</table>";
    ?>

</body>
</html>