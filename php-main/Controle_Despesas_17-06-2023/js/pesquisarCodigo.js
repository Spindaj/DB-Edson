//alert("Carregou")
// Recupera o id do cliente
async function pesquisar() {
    var contas_codigo_cliente = document.getElementById("CodCliente").value;
    console.log(contas_codigo_cliente);
    codigo_cliente.innerHTML = contas_codigo_cliente.value;
}

// Efetua a requisição para o arquivo pesquisar.php
//var dados = await fetch("pesquisar.php?codigo=" + contas_codigo_cliente);
//var resposta = await dados.json();

//console.log(resposta);