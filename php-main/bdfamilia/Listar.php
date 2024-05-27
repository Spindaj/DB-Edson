<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Pedido</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <form name="pedido" method="post" action="">
        <label>Informe o nr. da venda:</label><br>
        <input type="number" name="idvenda" min='1' max='20000' required><br>
        <input type="submit" class="btn btn-primary mt-2" name="buscar" value="Buscar">

    </form>
        <?php
        // Desativar todos os relatórios de erros 
        error_reporting(0);
        if(isset($_POST['buscar']))
        {            
            $idvenda      =   filter_input(INPUT_POST, 'idvenda');
            echo "Pedido: " .$idvenda;
            require "conexao.php";
            
            $lista = []; // Inicializa o vetor lista
            $sql = $conexao->query("SELECT comanda.id_venda, tbprodutos.nomeproduto, comanda.quantidade, comanda.preco_unitario FROM comanda INNER JOIN tbprodutos ON comanda.id_produto = tbprodutos.idprodutos WHERE id_venda = '$idvenda'");
            if ($sql->rowCount() > 0) 
            {
                $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
            }
            else
            {
                echo "<p>Venda não encontrada!</p>";
            }
        }
        ?>
        <table border='1'>
            <tr>
                <th width='250'>Descrição</th>
                <th width='50'>Qtde</th>
                <th width='120'>Vl.Unit</th>
                <th width='120'>Total</th>
            </tr>
            <?php 
                $Total_Geral = 0; // Inicialize Total_Geral
                foreach ($lista as $itens) : 
            ?>
                <tr>
                    <td><?= $itens["nomeproduto"];?></td>
                    <td align='right'><?= $itens["quantidade"];?></td>
                    <td align='right'>R$ <?= number_format($itens["preco_unitario"],2,",",".");?></td>
                    <td align='right'><?= number_format($itens["quantidade"] * $itens["preco_unitario"],2,",","."); ?></td>
                </tr>
                <?php 
                    $Total_Geral += $itens["quantidade"] * $itens["preco_unitario"]; // Incrementa o total geral
                ?>
            <?php endforeach; ?>

            <?php
                // Display the total at the end of the table
                echo "<tr><td colspan='4' align='right'>Total Geral:</td><td align='right'>R$ " . number_format($Total_Geral, 2, ",", ".") . "</td></tr>";
            ?>
    </table>
    header("location: estoque.php");
    <a href="principal.html" class="btn btn-danger mt-2">Finalizar</a>
    </div>
</body>
</html>