USE bdfamilia

CREATE TABLE `tbcadastro` (
  `idcliente` int(5) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(60) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `cell` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `datacadastro` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40

CREATE TABLE `tbprodutos` (
  `idprodutos` int(5) NOT NULL AUTO_INCREMENT,
  `nomeproduto` varchar(60) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `quantidade` decimal(8,2) NOT NULL,
  `datacompra` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idprodutos`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

CREATE TABLE `tbvenda` (
  `idvenda` int(5) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `datalancamento` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idvenda`),
  KEY `id_cliente` (`id_cliente`),
  CONSTRAINT `tbvenda_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `tbcadastro` (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

CREATE TABLE `comanda` (
  id_venda int(5) NOT NULL,
  item int(5) NOT NULL,
  id_produto int(11) NOT NULL,
  quantidade decimal(8,2) NOT NULL,
  preco_unitario decimal(8,2) NOT NULL,
  PRIMARY KEY (id_venda, item),
  CONSTRAINT `comanda_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `tbprodutos` (`idprodutos`),
  CONSTRAINT `comanda_ibfk_2` FOREIGN KEY (`id_venda`) REFERENCES `tbvenda` (`idvenda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

SELECT comanda.id_venda, tbprodutos.nomeproduto, comanda.quantidade, comanda.preco_unitario FROM comanda INNER JOIN tbprodutos ON comanda.id_produto = tbprodutos.idprodutos WHERE id_venda = 36