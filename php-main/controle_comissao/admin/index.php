<?php
    error_reporting(0); // Ignora possíveis erros de codificação
    session_start(); // Inicia a sessão
    // Verifica se a sessão do usuário está definida, através do comando isset
    if(isset($_SESSION['usuario'])) {
        echo "Seja-bem vindo " .$_SESSION["usuario"] . "<br>";
    } else {
        echo "Você precisa realizar o login!";
        //echo "<meta http-equiv='refresh' content='2;url=index.php'>";
        header("Location: ..\index.php");
    }    
    // Verifica se o nível do usuário é administrador
    if($_SESSION["nivel"] !=1) {
        header("Location: ..\index.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Comissão</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <div class="container">        
    <p class="text-center text-info">    
        <a href="Vendedor_Inserir.php">Cadastrar Vendedor</a> |
        <a href="Vendedor_Pesquisar.php">Pesquisar Vendedor</a>
    </p>
    <p class="text-center">
        <img src="../imagens/vendedor.png" alt="Cadastro de Vendedor" width="30%">
    </p>
    </div>
    <h4 class="text-center"><a href="../principal.php">Voltar</a></h4>
</body>
</html>