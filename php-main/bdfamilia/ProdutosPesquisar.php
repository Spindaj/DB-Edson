<!DOCTYPE html>
<html lang="br-pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar Produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <p class="p-3 mb-2 bg-info text-white text-center"> Pesquisar Produtos</p>
            <?php
            require "conexao.php";
            $lista = []; //INICIALIZA O VETOR $lista
            $sql = $conexao->query("SELECT * FROM tbprodutos ORDER BY idprodutos");

            if ($sql->rowCount() > 0) // SE ENCONTROU PELO MENOS 1 LINHA
            {
                $lista = $sql->fetchALL(PDO::FETCH_ASSOC);
            }
            ?>

        <table border='1' align="center" class='text-center' width='800'>
            <tr>
                <th width='40'>ID</th>
                <th width='220'>Nome Produto</th>
                <th width='110'>Preço</th>
                <th width='40'>Quantidade</th>
                <th width='90'>Data Compra</th>

            </tr>


            <?php
            foreach ($lista as $Nome_Produto) : ?>

                <tr>
                    <td align='right'><?php echo $Nome_Produto['idprodutos'] ?></td>
                    <td align='left'><?php echo $Nome_Produto['nomeproduto'] ?></td>
                    <td align='right'>R$ <?= number_format($Nome_Produto["preco"],2,",",".");?></td>
                    <td align='right'><?php echo number_format($Nome_Produto['quantidade'],2,",",".") ?></td>
                    <td><?= date('d/m/Y', strtotime($Nome_Produto['datacompra'])); ?></td>
                </tr>
                <p>
                    </form>
                <?php endforeach; ?>
        </table>


        <p class="text-center"><a href="principal.html" class="btn btn-danger mt-2">Voltar</a></p>
    </div>
</body>

</html>