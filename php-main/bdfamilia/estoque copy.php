<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque dos Produtos após a venda realizada</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <h3>Estoque dos Produtos após a venda realizada</h3>
<?php

// Configurações do banco de dados
$dsn = 'mysql:host=localhost;dbname=bdfamilia';
$username = 'root';
$password = '';

// Conexão com o banco de dados usando PDO
try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Função para atualizar a quantidade de produtos na tabela de produtos
function atualizarQuantidadeProduto($pdo, $id_produto, $quantidade_vendida) {
    try {
        // Preparar a consulta SQL para atualizar a quantidade de produtos
        $sql = "UPDATE tbprodutos SET quantidade = quantidade - :quantidade_vendida WHERE idprodutos = :id_produto";

        // Preparar e executar a declaração
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':quantidade_vendida', $quantidade_vendida, PDO::PARAM_INT);
        $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
        $stmt->execute();

        echo "Quantidade de produtos atualizada com sucesso.";
        header("location: principal.html");
    } catch (PDOException $e) {
        echo "Erro ao atualizar a quantidade de produtos: " . $e->getMessage();
    }
}

// Exemplo de uso: obter as vendas da tabela de comandas e atualizar a quantidade de produtos
try {
    // Consulta SQL para selecionar as vendas da tabela de comandas
    $sql_vendas = "SELECT id_produto, quantidade FROM comanda";

    // Preparar e executar a consulta
    $stmt_vendas = $pdo->query($sql_vendas);

    // Loop através das vendas
    while ($row = $stmt_vendas->fetch(PDO::FETCH_ASSOC)) {
        // Atualizar a quantidade de produtos para cada venda
        atualizarQuantidadeProduto($pdo, $row['id_produto'], $row['quantidade']);
    }
} catch (PDOException $e) {
    echo "Erro ao obter as vendas da tabela de comandas: " . $e->getMessage();
}

?>
</body>
</html>