<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Vendedor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>   
    <div class="container">
        <div class="text-center">
            <img src="../imagens/vendedor.png" class="rounded" alt="..." width="30%">
        </div>

        <form name="vendedor" method="post" action="">
            <p>
                <label class="form-label col-form-label">Vendedor:</label>
                <input type="text" name="vendedor" class="form-control"  size="30" maxlength="30" placeholder="Informe o nome do vendedor" required>
            </p>
            <p>
                <label class="form-label">E-mail:</label>
                <input type="email" name="email" class="form-control"  size="20" maxlength="20" placeholder="Informe o seu email" required>
            </p>
            <p>
                <label class="form-label">Contato:</label>
                <input type="text" name="contato" class="form-control"  size="20" maxlength="20" placeholder="Informe o seu contato" required>
            </p>
            <p>
                <input type="submit" name="inserir" value="Inserir" class="btn btn-primary">
                <input type="reset" name="apagar" value="Apagar" class="btn btn-danger">
                <a class="btn btn-info" href="../" role="button">Voltar</a>
            </p>
        </form>
    </div>
    <?php 
    if(isset($_POST["inserir"])) {
            $vendedor    =   $_POST["vendedor"];
            $email      =   $_POST["email"];
            $contato      =   $_POST["contato"];
            require "../conexao.php";
            $sql="INSERT INTO tbvendedor(idvendedor, vendedor, email, contato)";
            $sql.=" VALUES(null,'$vendedor', '$email','$contato')" or die(mysqli_error($conexao));
            mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
            echo "<script type=\"text/javascript\">alert('Vendedor Inserido com Sucesso!'); </script>";
        }

    ?>
       
</body>
</html>