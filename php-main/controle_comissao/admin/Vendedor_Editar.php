<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Comissão - Editar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        td {
            padding:3px;
        }
        label, input {
            color:blue;
        }
    </style>
</head>

<body>
    <div class="container">
        <p class="text-center">
            <img src="../imagens/vendedor.png" alt="Cadastro de Vendedor" width="30%">
        </p>
        <?php
        echo "<h4 class='text-center text-info'>Controle de Comissão - Editar Vendedor</h4>";
        require "../conexao.php";
        $idvendedor=$_REQUEST["idvendedor"]; // Recupera o idvendedor referente a pesquisa efetuada
        $sql="SELECT * FROM tbvendedor WHERE idvendedor='$idvendedor'";
        $resultado=mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
        $linha=mysqli_fetch_array($resultado);
        $idvendedor =   $linha["idvendedor"];
        $vendedor   =   $linha["vendedor"];
        $email      =   $linha["email"];
        $contato    =   $linha["contato"];

        echo "<form name='vendedor' method='post' action=''>";
            echo "<table>";
                echo "<tr>";
                    echo "<td><label>IdVendedor:</label></td>";
                    echo "<td><input type='text' name='idvendedor' size='5' value='$idvendedor' readonly>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td><label>Vendedor:</label></td>";
                    echo "<td><input type='text' name='vendedor' size='60' maxlength='60' value='$vendedor' required></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td><label>E-mail:</label></td>";
                    echo "<td><input type='email' name='email' size='30' maxlength='30' value='$email' required></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td><label>Contato:</label></td>";
                    echo "<td><input type='text' name='contato' size='15' maxlength='15' value='$contato' required>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td colspan='2' align='center'><input type='submit' value='Editar' name='editar' class='btn btn-primary'>";
                    echo "&nbsp;<a href='Vendedor_Pesquisar.php' class='btn btn-danger'>Voltar</a></td>";
                echo "</tr>";
                echo "</td>";
            echo "</table>";
        echo "</form>";

        if(isset($_POST['editar'])) {
            $idvendedor =   $_POST["idvendedor"];
            $vendedor   =   $_POST["vendedor"];
            $email      =   $_POST["email"];
            $contato    =   $_POST["contato"];
            $sql="UPDATE tbvendedor SET vendedor='$vendedor', email='$email', contato='$contato' WHERE idvendedor='$idvendedor'";
            mysqli_query($conexao, $sql)  or die(mysqli_error($conexao));
            echo "<script type=\"text/javascript\">alert('Vendedor Editado com sucesso!'); </script>";
            echo '<script>window.location.href = window.location.href;</script>';
        }
        ?>        
    </div>
</body>

</html>