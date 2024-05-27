<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Contas - Despesa</title>
    <link rel="stylesheet" href="estilos_menu.css">
    <link rel="stylesheet" href="estilos_formulario.css">

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
<?php 
    require "menu.php";
    require "conexao.php";
    echo "<h3>EDITAR - CADASTRO DE CLIENTES </h3>";
    $codigo=$_REQUEST["codigo"];
    $sql="SELECT * FROM clientes WHERE codigo='$codigo'";
    $resultado=mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
    $linha=mysqli_fetch_array($resultado);
    $codigo  = $linha["codigo"];
    $nome    = $linha["nome"];
    $cidade  = $linha["cidade"];
    $cpf     = $linha["cpf"];
    $email   = $linha["email"];
    $contato = $linha["contato"];
    $situacao= $linha["situacao"];
    
    echo "<form name='cadastro' method='post' action=''>";
        echo "<table align='center'>";
            echo "<tr>";
                echo "<td label='codigo'>Código:<label></td>";
                echo "<td><input type='text' name='codigo' value=$codigo size='4' readonly></td>";                
            echo "</tr>";
            echo "<tr>";
                echo "<td label='nome'>Nome:<label></td>";
                echo "<td><input type='text' name='nome' value=$nome size='40' maxlength='50'></td>";                
            echo "</tr>";
            echo "<tr>";
                echo "<td label='cidade'>Cidade:<label></td>";
                echo "<td><input type='text' name='cidade' value=$cidade size='35' maxlength='35'></td>";                
            echo "</tr>";
            echo "<tr>";
                echo "<td label='cpf'>CPF:<label></td>";
                echo "<td><input type='text' name='cpf' value=$cpf size='14' maxlength='14' class='cpf'></td>";                
            echo "</tr>";
            echo "<tr>";
                echo "<td label='email'>E-mail:<label></td>";
                echo "<td><input type='text' name='email' value=$email size='35' maxlength='35'></td>";                
            echo "</tr>";
            echo "<tr>";
                echo "<td label='contato'>Contato:<label></td>";
                echo "<td><input type='text' name='contato' value=$contato class='fone'></td>";                
            echo "</tr>";            
            echo "<tr>";
                echo "<td label='situacao'>Situação:<label></td>";
                echo "<td><input type='text' name='situacao' value=$situacao></td>";                
            echo "</tr>";  
            echo "<tr>";
                echo "<td colspan='2'>";
                    echo "<input type='submit' name='salvar' value='Salvar'>";
                echo "</td>";
            echo "</tr>";
        echo "</table>";
    echo "</form>";
if(isset($_POST["salvar"]))
{
    $codigo = $_POST["codigo"];
    $nome   = $_POST["nome"];
    $email  = $_POST["email"];
    $contato = $_POST["contato"];
    $situacao = $_POST["situacao"];

    require "conexao.php";
    $sql="UPDATE clientes SET nome='$nome',";
    $sql.= " email='$email',";
    $sql.= " contato='$contato',";
    $sql.= " situacao='$situacao'";
    $sql.= " WHERE codigo='$codigo'";
    echo $sql;
    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
    echo "Cliente alterado com sucesso!";
    echo "<meta http-equiv='refresh' content='4;url=clientes_pesquisar.php'>";
}
?>
</body>
</html>