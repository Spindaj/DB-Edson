<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque dos Produtos após a venda realizada</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <p class="p-3 mb-2 bg-info text-white text-center">Atualiza o estoque dos Produtos após a venda realizada</p>
        <?php
        session_start();
        $Venda =  $_SESSION['idvenda'];
        echo "<strong>Venda nr: </strong>" . $Venda;

        require "conexao.php";
        try {
            // Consulta SQL para selecionar as vendas da tabela de comandas
            $sql_vendas = "SELECT id_venda, id_produto, quantidade FROM comanda WHERE id_venda = '$Venda'";
            // Preparar e executar a consulta
            $stmt_vendas = $conexao->query($sql_vendas);

            // Loop através das vendas
            while ($row = $stmt_vendas->fetch(PDO::FETCH_ASSOC)) {
                // Atualizar a quantidade de produtos para cada venda
                atualizarQuantidadeProduto($conexao, $row['id_produto'], $row['quantidade']);
            }
        } catch (PDOException $e) {
            echo "Erro ao obter as vendas da tabela de comandas: " . $e->getMessage();
        }

        // Função para atualizar a quantidade de produtos na tabela de produtos de acordo com a venda finalizada
        ?>

        <?php
        function atualizarQuantidadeProduto($pdo, $id_produto, $quantidade_vendida)
        {
            try {
                // Preparar a consulta SQL para atualizar a quantidade de produtos
                $sql = "UPDATE tbprodutos SET quantidade = quantidade - :quantidade_vendida WHERE idprodutos = :id_produto";
                require "conexao.php";
                // Preparar e executar a declaração
                $stmt = $conexao->prepare($sql);
                $stmt->bindParam(':quantidade_vendida', $quantidade_vendida, PDO::PARAM_INT);
                $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
                $stmt->execute();

                echo "Quantidade de produtos atualizada com sucesso.";
                header("location: principal.html");
            } catch (PDOException $e) {
                echo "Erro ao atualizar a quantidade de produtos: " . $e->getMessage();
            }
        }
        ?>
    </div>
</body>

</html>