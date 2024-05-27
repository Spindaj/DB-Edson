<?php
require "conexao.php";
$lista = []; //INICIALIZA O VETOR $lista
$sql = $conexao->query("SELECT * FROM tbprodutos ORDER BY idprodutos");

if ($sql->rowCount() > 0) // SE ENCONTROU PELO MENOS 1 LINHA
{
    $lista = $sql->fetchALL(PDO::FETCH_ASSOC);
} else {
    echo "<script>alert('Não há produtos cadastrados!');</script>";
    echo "<meta http-equiv='refresh' content='0;url=principal.html' />";
}

$lista = [];
$sql = $conexao->query("SELECT * FROM tbcadastro ORDER BY Nome");
if ($sql->rowCount() > 0) 
{
    $lista = $sql->fetchALL(PDO::FETCH_ASSOC);
} else {
    echo "<script>alert('Não há clientes cadastrados!');</script>";
    echo "<meta http-equiv='refresh' content='0;url=principal.html' />";
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VENDA</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <p class="text-primary text-center">Venda</p>
        <form name="Venda" method="post" action="">
            <label>Selecione o cliente: </label><br>
            <select name="idcliente" required>
                <option></option>
                <?php
                require "conexao.php";
                $stmt = $conexao->query("SELECT * FROM tbcadastro ORDER BY Nome");
                while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value={$linha['idcliente']}>{$linha['Nome']}</option>";
                }
                ?>
                <p>
            </select>
            </p>
            <p>
                <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary">
                <a href="principal.html" class="btn btn-danger">Voltar</a>
            </p>
        </form>
        <?php
        if (isset($_POST["cadastrar"])) {
            try {
                $idcliente      =   filter_input(INPUT_POST, 'idcliente');

                require "conexao.php";

                $sql = $conexao->prepare("INSERT INTO tbvenda (id_cliente) VALUES (:id_cliente)");
                $sql->bindValue(':id_cliente', $idcliente);
                $sql->execute();
                // Exibir mensagem JavaScript e efetuar refresh na página
                echo '<script>alert("Venda cadastrada com sucesso!");</script>';
                echo '<script>window.location.href = window.location.href;</script>';
                session_start();
                $_SESSION['Item'] = 0;
                $_SESSION['idcliente'] = $idcliente;
                header("location: CriarVenda.php");
            } catch (PDOException $e) {
                echo "Erro ao cadastrar a venda: " . $e->getMessage();
            }
        }
        ?>
    </div>
</body>

</html>