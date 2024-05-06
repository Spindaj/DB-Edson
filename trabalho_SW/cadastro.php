<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Cadastro</title>
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

    <form name="login" method="post" action="" class="container form-floating" id="cadastro">
        <center><h2>CADASTRAR FORNECEDOR</h2></center>
        <br>
        <div class="form-floating mb-3">
            <input type="text" name="nome" size="50" maxlenght="30" class="form-control" id="floatingInput" placeholder="name@example.com" required>
            <label for="floatingInput">Nome</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="cidade" size="30"  maxlenght="60" class="form-control" id="cidade" placeholder="Cidade" required>
            <label for="cidade">Cidade</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="cnpj" size="30" maxlenght="20" class="form-control" id="cnpj" placeholder="CNPJ" required>
            <label for="cnpj">CNPJ</label>
        </div>
            <input type="submit" name="inserir" value="Inserir" class="btn btn-primary">
            <a href='#' class="btn btn-danger">Voltar</a>
    </form>

    <?php
        if(isset($_POST["inserir"])) {
            $nome = $_POST["nome"];
            $cidade = $_POST["cidade"];
            $cnpj = $_POST["cnpj"];
            require "conexao.php";
            $sql="INSERT INTO tbfornecedor(idfornecedor, nome, cidade, cnpj)";
            $sql.=" VALUES(null,'$nome','$cidade', '$cnpj')" or die(mysqli_error($conexao));
            mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
            echo "<script type=\"text/javascript\">alert('Usuário Cadastrado com sucesso!'); </script>";
        }
    ?>
</body>
</html>