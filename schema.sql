create database landing;

use landing;

create table tbl_servicos (
id_servico int primary key not null,
descricao varchar (50) not null
);

create table tbl_clientes(
id_cliente int primary key not null,
nome varchar (50) not null,
telefone varchar (50) not null,
email varchar (50) not null,
id_servico int,
foreign key (id_servico) references tbl_servicos(id_servico)
);
