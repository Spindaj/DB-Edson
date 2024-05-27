<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h3>Criar Conta de Usuário</h3>
        <form name="login" method="post" action="">
            <div class="form-group"> 
                <label for="nome">Nome:</label>
                <input type="text" name="nome" required>
            </div>
            <div class="form-group">
                <label for="usuario">Usuário:</label>
                <input type="text" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" required>
            </div>
            <div class="form-group">
                <label for="confirmar_senha">Confirmar senha:</label>
                <input type="password" name="confirmar_senha" required>
            </div>
            <input type="submit" value="Cadastrar" name="cadastrar">
        </form>
        <p align="center"><a href="login.html">Efetuar Login</a></p>
    </div>
    <?php
        if(isset($_POST["cadastrar"]))
        {
            $nome      = $_POST["nome"];
            $usuario   = $_POST["usuario"];
            $senha     = $_POST["senha"];
            $confSenha = $_POST["confirmar_senha"];
            
            if($senha == $confSenha)
            {
                require "conexao.php";
                $sql="INSERT INTO usuario (codigo,nome,usuario,senha)";
                $sql.=" VALUES (null, '$nome','$usuario','$senha')";
                mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
                echo "<p align='center'>Conta cadastrada com sucesso!</p>";
            }
            else    
            {
                echo "<p align='center'>A senha de confirmação está inválida!</p>";
            }
        }
    ?>
</body>
</html>