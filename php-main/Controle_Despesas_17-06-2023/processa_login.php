<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação do Login</title>
</head>
<body>
    <?php
        echo "<h3>VERIFICAÇÃO DO LOGIN</h3>";
        $usuario = $_POST["usuario"];
        $senha   = $_POST["senha"];

        require "conexao.php";
        $query = "SELECT * FROM usuario WHERE usuario = '$usuario' AND senha = '$senha'";
        $sql = mysqli_query($conexao, $query) or die(mysqli_error($conexao));
        $resultado =mysqli_num_rows($sql);

        if ($resultado == 0) {
            echo "<p>Usuário ou Senha Inválida</p>";
            echo "<p align='center'><a href='login.html'>Efetuar Login</p>";
        }
        else
        {
            session_start();
            $_SESSION["usuario"] = $usuario;
            header("location:principal.php"); // Carrega a página principal
            //echo "<p align='center'><a href='principal.php'>Acessar Site</p>";
        }
    ?>
</body>
</html>