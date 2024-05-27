<?php
session_start();
$Item = $_SESSION['Item'];
$idcliente = $_SESSION['idcliente'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lançar os itens da venda</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
<!-- <script src="js/pesquisar.js"></script> -->
<script>
        function pesquisar() {
            // JavaScript código para recuperar o código do cliente
            const selecao = document.getElementById("idProduto");
            const codigoClienteEntrada = document.getElementById("codigo_cliente");
            const selecionado = selecao.value;

            codigo_cliente.value = selecionado;
        }
    </script>
    <div class="container">
    <p class="p-3 mb-2 bg-info text-white text-center">Comanda - Lançar os itens da venda</p>
        <?php
        require "conexao.php";
        $lista = [];
        $sql = $conexao->prepare("SELECT * FROM tbvenda ORDER BY idvenda DESC");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $lista = $sql->fetch(PDO::FETCH_ASSOC);
        }
        $Venda_Itens =  $lista['idvenda'];
        echo "<strong>Venda nr: </strong>" . $lista['idvenda'];

        $cliente =[];
        $sql = $conexao->query("SELECT * FROM tbcadastro WHERE idcliente = '$idcliente'");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $cliente = $sql->fetch(PDO::FETCH_ASSOC);
        }
        echo "<br><strong>Nome do cliente: </strong>" . $cliente['Nome'];
        ?>

        <form method="POST" name="itens" action="">
            <p>
                <label>Produto:</label><br>
                <select name="idProduto" id="idProduto" required onchange="pesquisar()">
                    <option></option>
                    <?php
                    require "conexao.php";
                    $stmt = $conexao->query("SELECT * FROM tbprodutos ORDER BY nomeproduto");
                    while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value={$linha['idprodutos']}>{$linha['nomeproduto']}</option>";
                    }
                    ?>
                </select>
                <input type='text' name='id_produto' id='codigo_cliente' size='5' maxlength='5' required>
            </p>
            <p>
                <label for="quantidade">Quantidade: </label><br>
                <input type="number" name="quantidade" step="0.01" min="1" max="100" required><br>
            </p>
            <p>
                <label for="preco_unitario">Preço Unitário: </label><br>
                <input type="number" name="preco_unitario" step="0.01" min="1" max="2000" required><br>
            </p>

            <input type="submit" value="Salvar" name="salvar" class="btn btn-primary mb-2">
        </form>
        <?php
        if(isset($_POST['salvar']))
        {
            require "conexao.php";
            $Item++;
            echo "<p>Item: " . $Item . "</p>";
            $id_produto= filter_input(INPUT_POST, 'id_produto');
            $quantidade = filter_input(INPUT_POST,'quantidade');
            $preco_unitario = filter_input(INPUT_POST,'preco_unitario');
            $TotalItem = $quantidade * $preco_unitario;
            echo "Total: R$ ". number_format($TotalItem, 2, ',', '.');

            $sql = $conexao->prepare("INSERT INTO comanda (id_venda, item, id_produto, quantidade, preco_unitario) VALUES (:id_venda, :item, :id_produto, :quantidade, :preco_unitario)");
            $sql->bindValue(':id_venda', $Venda_Itens);
            $sql->bindValue(':item', $Item);
            $sql->bindValue(':id_produto', $id_produto);
            $sql->bindValue(':quantidade', $quantidade);
            $sql->bindValue(':preco_unitario', $preco_unitario);
            $sql->execute();
            echo "Item cadastrado com sucesso!";
            $_SESSION['Item'] = $Item;
            $_SESSION['idvenda'] = $Venda_Itens;
            echo '<script>window.location.href = window.location.href;</script>';
        }

        ?>
    </div>
    <div class="container">
    <?php
    require "conexao.php";
    $lista = []; 
    $sql = $conexao->query("SELECT comanda.id_venda, tbprodutos.nomeproduto, comanda.quantidade, comanda.preco_unitario FROM comanda INNER JOIN tbprodutos ON comanda.id_produto = tbprodutos.idprodutos WHERE id_venda = '$Venda_Itens'");
    if ($sql->rowCount() > 0) 
    {
        $lista = $sql->fetchALL(PDO::FETCH_ASSOC);
    }
    ?>
    <table border='1' align='center' class='text-center' width='1000'>
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
                // Mostra o total geral dos itens
                echo "<tr><td colspan='4' align='right'>Total Geral:</td><td align='right'>R$ " . number_format($Total_Geral, 2, ",", ".") . "</td></tr>";
                echo "<tr>";
                    echo "<td colspan='5' align='center'><a href='estoque.php' class='btn btn-danger mt-2'>Finalizar</a></td>";
                echo "</tr>";
                
            ?>
    </table>
    
    <!-- <a href="principal.html" class="btn btn-danger mt-2">Finalizar</a>-->
    </div>
</body>

</html>