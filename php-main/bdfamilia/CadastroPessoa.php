<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
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
        <p class="p-3 mb-2 bg-info text-white text-center">Cadastrar Cliente</p>
        <form name="cadastro" method="POST" action="">
            <p>
                <label>Nome:</label><br>
                <input type="text" name="Nome" size="35" maxlength="50" required placeholder="Informe o nome completo"><br>
            </p>
            <p>
                <label>CPF:</label><br>
                <input type="text" name="cpf" size="15" maxlength="20" class="cpf" required><br>
            </p>

            <p>
                <label>Cell:</label><br>
                <input type="text" name="cell" size="15" maxlength="15"  class="fone" required><br>
            </p>

            <p>
                <label>E-mail:</label><br>
                <input type="email" name="email" size="50" maxlength="60" required><br>
            </p>
            <p>
                <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary">
                <a href="principal.html" class="btn btn-danger">Voltar</a>
            </p>
        </form>

        <?php
        if (isset($_POST["cadastrar"])) {
            require "conexao.php"; //CHAMA O NEGÓCIO LÁ O BANCO DE DADOS

            $nome = filter_input(INPUT_POST, 'Nome');
            $cpf = filter_input(INPUT_POST, 'cpf');
            $cell = filter_input(INPUT_POST, 'cell');
            $email = filter_input(INPUT_POST, 'email');
            $datacadastro = filter_input(INPUT_POST, 'datacadastro');

            $sql = $conexao->prepare("INSERT INTO tbcadastro (Nome, cpf, cell, email, datacadastro) VALUES (:Nome, :cpf, :cell, :email, :datacadastro)");

            $sql->bindValue(':Nome', $nome);
            $sql->bindValue(':cpf', $cpf);
            $sql->bindValue(':cell', $cell);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':datacadastro', $datacadastro);

            $sql->Execute();

            echo "<script>alert('Cliente cadastrado successo!');</script>";
            echo "<script>window.location.href = window.location.href;</script>";
        }
        ?>

    </div>
    <div class="container">
    <?php
    require "conexao.php";
    $lista = []; 
    $sql = $conexao->query("SELECT * FROM tbcadastro ORDER BY Nome");
    if ($sql->rowCount() > 0) // SE ENCONTROU PELO MENOS 1 LINHA
    {
        $lista = $sql->fetchALL(PDO::FETCH_ASSOC);
    }
    ?>
    <table border='1' align='center' class='text-center' width='1000'>
        <tr>
            <th>ID</th>
            <th>Nome do Cliente</th>
            <th>CPF</th>
            <th>Contato</th>
            <th>E-mail</th>
            <th>Dt.Cad</th>
            <th>Editar</th>
        </tr>
        <?php
        foreach ($lista as $cliente) : ?>
            <tr>
                <td align='right' width='60'><?php echo $cliente['idcliente'] ?></td>
                <td align='left'><?php echo $cliente['Nome'] ?></td>
                <td align='left'><?php echo $cliente['cpf'] ?></td>
                <td align='left'><?php echo $cliente['cell'] ?></td>
                <td align='left'><?php echo $cliente['email'] ?></td>
                <td><?= date('d/m/Y', strtotime($cliente['datacadastro'])); ?></td>
                <td align='center'><a href="EditarPessoa.php?idcliente=<?= $cliente['idcliente']; ?>">[ Editar]</a></td>
            </tr>
            </form>
        <?php endforeach; ?>
    </table>
    </div>
</body>

</html>