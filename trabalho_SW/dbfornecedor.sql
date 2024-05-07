create database BDFornecedor

use BDFornecedor

create table TBFornecedor
(
	idfornecedor int(4) auto_increment primary key,
	nome varchar(50) not null,
    cidade varchar(60) not null,
    cnpj int(15) not null,
    situacao char(1) default 'A'
)
