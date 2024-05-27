<?php
try {
$conexao = new PDO("mysql:dbname=bdfamilia;charset=utf8;host=localhost:3306","root","");
$conexao->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $erro)
{

echo "erro ao conectar" . $erro->getMessage();

}


?>