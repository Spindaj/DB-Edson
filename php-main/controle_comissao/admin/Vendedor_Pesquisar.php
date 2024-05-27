<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Comissão - Pesquisa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        table {
            width:700px;
            th, td {
                border:1px dashed;                
                padding: 3px;
            }
            th {
                background-color: #666;
                color: white;
                font-weight: 800;
            }
            td:hover{
                background-color: blue;
                color:white;
            }
            a{
                font-family: 'Courier New';
                width:200px;
            }
            a:link {                
                text-decoration: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <p class="text-center">
            <img src="../imagens/vendedor.png" alt="Cadastro de Vendedor" width="30%">
        </p>
        <?php
            echo "<h4 class='text-center text-info'>Controle de Comissão - Pesquisa de Vendedor</h4>";
            require "../conexao.php";
            $sql="SELECT * FROM tbvendedor ORDER BY vendedor";
            $resultado=mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
            echo "<table align='center'>";
                echo "<tr>";
                    echo "<th>Código</th>";
                    echo "<th>Nome do vendedor</th>";
                    echo "<th>E-mail</th>";
                    echo "<th>Contato</th>";
                    echo "<th>Editar</th>";
                echo "</tr>";
                while($linha=mysqli_fetch_array($resultado)) {
                    $idvendedor     =   $linha["idvendedor"];
                    $vendedor       =   $linha["vendedor"];
                    $email          =   $linha["email"];
                    $contato        =   $linha["contato"];

                    echo "<tr>";
                        echo "<td align='right'>$idvendedor</td>";
                        echo "<td align='left'>$vendedor</td>";
                        echo "<td align='left'>$email</td>";
                        echo "<td align='right'>$contato</td>";
                        echo "<td><a href='Vendedor_Editar.php?idvendedor=$idvendedor'>Editar</a></td>";
                    echo "<tr>";
                }
            echo "</table>";   
        ?>
        <h4 class="text-center"><a href="index.php">Voltar</a></h4>
    </div>
</body>
</html>