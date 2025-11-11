create database landing;

use landing;

create table tbl_servicos (
id_servico int AUTO_INCREMENT primary key not null,
descricao varchar (50) not null
);

select*from tbl_servicos;

INSERT INTO tbl_servicos (descricao) VALUES
('Desenvolvimento Web'),
('Suporte Técnico'),
('Segurança da Informação'),
('Consultoria em TI');



create table tbl_clientes(
id_cliente int AUTO_INCREMENT primary key not null,
nome varchar (50) not null,
telefone varchar (50) not null,
email varchar (50) not null,
id_servico int,
foreign key (id_servico) references tbl_servicos(id_servico)
):

select*from tbl_clientes;


drop table tbl_clientes
drop table tbl_servicos
