<?php
$contas_codigo_cliente = filter_input(INPUT_GET,"contas_codigo_cliente", FILTER_SANITIZE_NUMBER_INT);

$retorna = ["status" => false, "contas_codigo_cliente"];

echo json_encode($retorna);
?>