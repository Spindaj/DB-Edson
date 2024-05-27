<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery.mask.js"></script>
</head>

<body>
<script>
        $(function(){
            $(".fone").mask("(00) 00000-0000", {placeholder: "(00) 00000-0000"});
            $(".cep").mask("00000-000", {placeholder: "00000-000"});
            $(".cpf").mask("000.000.000-00", {placeholder: "000.000.000-00"});
        })
    </script>
    <div class="container">
        <p class="text-info text-center">Editar Cliente</p>
        <?php
        require "conexao.php";
        $lista = []; // Inicializa o vetor lista
        $idcliente = filter_input(INPUT_GET, "idcliente");
        $sql = $conexao->prepare("SELECT * FROM tbcadastro WHERE idcliente = :idcliente");
        $sql->bindValue(":idcliente", $idcliente);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $lista = $sql->fetch(PDO::FETCH_ASSOC);
        }
        ?>
        <form name="clientes" method="POST" action="">
            <p>
                <label>ID:</label><br>
                <input type="text" name="idcliente" size="4" maxlength="4" readonly value="<?= $lista['idcliente']; ?>">
            </p>
            <p>
                <label>Nome:</label><br>
                <input type="text" name="nome" size="50" maxlength="60" value="<?= $lista['Nome']; ?>">
            </p>
            <p>
                <label>CPF:</label><br>
                <input type="text" name="cpf" size="15" maxlength="15" class="cpf" value="<?= $lista['cpf']; ?>">
            </p>
            <p>
                <label>Contato:</label><br>
                <input type="text" name="cell" size="15" maxlength="15" class="fone" value="<?= $lista['cell']; ?>">
            </p>
            <p>
                <label>E-mail:</label><br>
                <input type="email" name="email" size="50" maxlength="50" value="<?= $lista['email']; ?>">
            </p>
            <p>
                <input type="submit" name="editar" value="Editar" class="btn btn-primary">
                <a href="CadastroPessoa.php" class="btn btn-danger">Voltar</a>
            </p>
        </form>
        <?php
        if (isset($_POST["editar"])) {
            require "conexao.php";
            $idcliente = filter_input(INPUT_POST, "idcliente");
            $nome = filter_input(INPUT_POST, "nome");
            $cpf = filter_input(INPUT_POST, "cpf");
            $cell = filter_input(INPUT_POST, "cell");
            $email = filter_input(INPUT_POST, "email");

            $sql = $conexao->prepare("UPDATE tbcadastro SET Nome =:nome, cpf =:cpf, cell =:cell, email =:email WHERE idcliente =:idcliente");
            $sql->bindValue(":idcliente", $idcliente);
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":cpf", $cpf);
            $sql->bindValue(":cell", $cell);
            $sql->bindValue(":email", $email);
            $sql->execute();
            echo "<script>alert('Cliente editado com sucesso!');</script>";
            echo "<script>window.location.href = window.location.href;</script>";
        }
        ?>
</body>

</html>