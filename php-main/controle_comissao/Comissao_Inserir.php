<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Comissão - Inserindo os dados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <p class="text-center">
            <img src="imagens/comissao.png" alt="Cadastro da Comissão" width="30%">
        </p>
        <h3 class="text-center text-info">Controle de Comissão - Lançamentos</h3>
        <form name="comissao" method="post" action="">
            <p>
                <label>Vendedor:</label><br>
                <input type="number" name="vendedor" size="4" maxlength="4" required>
            </p>
            <p>
                <label>Data:</label><br>
                <input type="date" name="data" required>
            </p>
            <p>
                <label>Vl da Venda:</label><br>
                <input type="number" name="vl_venda" step="0.01" min="1" max="99999" required>
            </p>
            <p>
                <label>% de comissão de Vendas:</label><br>
                <input type="number" name="percentual_comissao" step="0.01" min="1" max="10" required>
            </p>
            <p><input type="submit" name="inserir" value="Inserir" class="btn btn-primary" />
                <a href='principal.php' class="btn btn-danger">Voltar</a>
            </p>
        </form>
        <?php        
        if(isset($_POST["inserir"])) {
            $vendedor              =   $_POST["vendedor"];
            $data                  =   $_POST["data"];
            $vl_venda              =   $_POST["vl_venda"];
            $percentual_comissao   =   $_POST["percentual_comissao"];
            require "conexao.php";
            $sql="INSERT INTO tbcomissao(idcomissao, idcomissao_vendedor, data, valor_venda, percentual_comissao)";
            $sql.=" VALUES(null,'$vendedor', '$data', '$vl_venda', '$percentual_comissao')" or die(mysqli_error($conexao));
            mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
            echo "<script type=\"text/javascript\">alert('Comissão Cadastrada com sucesso!'); </script>";
            echo '<script>window.location.href = window.location.href;</script>';
        }
    ?>
    </div>
</body>

</html>