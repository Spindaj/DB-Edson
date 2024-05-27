<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Comissão - Inserir Vendedor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        body {
            width:1000px;
            margin:auto;
        }
        form {
            background-color: #FFF;
            padding-left: 100px;
        }

        label {
            display: block;
            float: left;
            width: 100px;

        }
        input[type=submit] {
    	width: 70px;
        height: 35px;
        background-color: blue;
        color: white;
        border-radius: 4px;
	    margin-left: 105px;
        cursor:pointer;
}
    </style>
</head>

<body>
    <div class="container">
        <p class="text-center">
            <img src="../imagens/vendedor.png" alt="Cadastro de Vendedor" width="30%">
        </p>
        <form name="vendedor" method="post" action="">
            <p>
                <label>Vendedor:</label>
                <input type="text" name="vendedor" size="40" maxlength="60" placeholder="Informe o nome do vendedor" required>
            </p>
            <p>
                <label>E-mail:</label>
                <input type="email" name="email" size="30" maxlength="30" required>
            </p>
            <p>
                <label>Contato:</label>
                <input type="text" name="contato" size="15" maxlength="15">
            </p>

            <p><input type="submit" name="inserir" value="Inserir" class="btn btn-primary" />
            <a href='index.php' class="btn btn-danger">Voltar</a>
        </p>
    </div>
    </form>
    </div>
    <?php
        if(isset($_POST["inserir"])) {
            $vendedor    =   $_POST["vendedor"];
            $email      =   $_POST["email"];
            $contato      =   $_POST["contato"];
            require "../conexao.php";
            $sql="INSERT INTO tbvendedor(idvendedor, vendedor, email, contato)";
            $sql.=" VALUES(null,'$vendedor','$email','$contato')" or die(mysqli_error($conexao));
            mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
            echo "<script type=\"text/javascript\">alert('Vendedor Cadastrado com sucesso!'); </script>";
            echo '<script>window.location.href = window.location.href;</script>';
        }
    ?>
</body>

</html>