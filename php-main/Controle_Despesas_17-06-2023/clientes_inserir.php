<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
    <link rel="stylesheet" href="estilos_menu.css">
    <link rel="stylesheet" href="estilos_formulario.css">

    <script src="js/jquery.js"></script>
    <script src="js/jquery.mask.js"></script>
</head>

<body>
<body>
    <script>
      $(function(){
          $(".fone").mask("(00) 00000-0000", {placeholder: "(00) 00000-0000"});
          $(".cep").mask("00000-000", {placeholder: "00000-000"});
          $(".cpf").mask("000.000.000-00", {placeholder: "000.000.000-00"});
      })
  </script>

    <?php require "menu.php"; ?>
    <h3>Cadastro de Clientes</h3>
    <form name="clientes" method="post" action="">
        <p>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required size="30" maxlength="50">
        </p>
        <p>
            <label for="cidade">Cidade:</label>
            <input type="text" name="cidade" required size="35" maxlength="35">
        </p>
        <p>
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" required class="cpf" size="14" maxlength="14">
        </p>
        <p>
            <label for="email">E-mail:</label>
            <input type="email" name="email" required size="30" maxlength="30">
        </p>
        <p>
            <label for="contato">Contato:</label>
            <input type="text" name="contato" required size="15" maxlength="15" class="fone">
        </p>
        <input type="submit" name="inserir" value="Inserir">
        </p>
    </form>
    <?php
    if (isset($_POST["inserir"])) {
        $nome       =   $_POST["nome"];
        $cidade     =   $_POST["cidade"];
        $cpf        =   $_POST["cpf"];
        $email      =   $_POST["email"];
        $contato    =   $_POST["contato"];

        require "conexao.php";
        $sql = "INSERT INTO clientes(codigo, nome, cidade, cpf, email, contato, situacao)";
        $sql .= " VALUES (null, '$nome', '$cidade', '$cpf', '$email', '$contato', 'A')";
        mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
        echo "<p>Cliente inserido com sucesso!</p>";
        echo "<meta http-equiv='refresh' content='4;url=clientes_pesquisar.php'>";
    }
    ?>
</body>

</html>