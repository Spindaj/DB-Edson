<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Produto</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <p class="p-3 mb-2 bg-info text-white text-center">Cadastro de Produto</p>
    <form name="nomeproduto" method="POST" action="">
      <p>
        <label>Nome Produto: </label><br>
        <input type="text" name="nomeproduto" size="50" maxlength="65" placeholder="Informe o nome do produto completo" required><br>
      </p>

      <p>

        <label>Preço de Custo: </label><br>
        <input type="number" name="preco" size="30" maxleght="30" step='0.01' required><br>
      </p>

      <p>

        <label>Quantidade: </label><br>
        <input type="number" name="quantidade" size="30" maxleght="30" required><br>
      </p>

      <p>

        <label>Data Compra com Fornecedor: </label><br>
        <input type="date" name="datacompra" size="20" maxleght="20" required><br>
      </p>

      <p>

        <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary">
        <a href="principal.html" class="btn btn-danger">Voltar</a></p>
    </form>
  </div>
  </p>


  <?php
  if (isset($_POST["cadastrar"])) {
    require "conexao.php";

    $nomeproduto = filter_input(INPUT_POST, 'nomeproduto');
    $preco = filter_input(INPUT_POST, 'preco');
    $quantidade = filter_input(INPUT_POST, 'quantidade');
    $datacompra = filter_input(INPUT_POST, 'datacompra');

    $sql = $conexao->prepare("INSERT INTO tbprodutos (nomeproduto, preco, quantidade, datacompra) VALUES (:nomeproduto, :preco, :quantidade, :datacompra)");

    $sql->bindValue(':nomeproduto', $nomeproduto);
    $sql->bindValue(':preco', $preco);
    $sql->bindValue(':quantidade', $quantidade);
    $sql->bindValue(':datacompra', $datacompra);

    $sql->Execute();

    echo "<script>alert('Produto cadastrado successo!');</script>";
    echo "<script>window.location.href = window.location.href;</script>";
  }

  ?>

</body>

</html>