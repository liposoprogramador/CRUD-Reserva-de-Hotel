#criando um banco de dados
CREATE DATABASE hotel64137;

#seta o banco que deseja trabalhar
use hotel64137;

#DDL
CREATE TABLE cliente(
	id int not null AUTO_INCREMENT,
	nome varchar(100)not null,
  idade int null,
	sexo char(1) null,
	primary key(id)
)

CREATE TABLE funcionario(
	id int not null AUTO_INCREMENT,
	nome varchar(100) not null,
	telefone varchar(30) null,
	primary key(id)
)

CREATE TABLE quarto(
	id int not null AUTO_INCREMENT,
    descricao varchar(100)not null,
	status varchar(30)not null,
	valor numeric(9,2)not null,
	primary key(id)	
)

CREATE TABLE reserva(
	id int not null AUTO_INCREMENT,
	id_func int not null,
	id_cliente int not null,
	id_quarto int not null,
	data_ini date not  null,
	data_fim date null,	
	qtd_dias int null,
	primary key(id),
	CONSTRAINT fk_reserva_func foreign key(id_func)
	references funcionario(id),
	constraint fk_reserva_cliente foreign key(id_cliente)
	references cliente(id),
	constraint fk_reserva_quarto foreign key(id_quarto)
	references quarto(id)
)


create view vw_listareserva
as
select cli.nome as 'Nome Cliente', func.nome as 'Nome Funcionario',
			 re.data_ini, re.data_fim, qt.valor, re.qtd_dias, qt.descricao, qt.id as 'id_quarto'		 
from reserva re
inner join cliente cli on cli.id = re.id_cliente
inner join funcionario func on func.id = re.id_func
inner join quarto qt on qt.id = re.id_quarto

select * from vw_listareserva



where qtd_dias = 3

#DML , qt.status,
INSERT INTO cliente(nome, idade, sexo)
VALUES('Anildo', 34, 'M')

INSERT INTO cliente VALUES(0, 'Aline', 40, 'F');

select * from quarto

INSERT INTO funcionario(telefone, nome)
VALUES('71 99993256', 'Viviane')
select * from funcionario

INSERT INTO quarto(descricao, status, valor)
VALUES('Quarto de Luxo', 'Livre', 100)
select * from quarto

INSERT INTO reserva(id_func, id_cliente, id_quarto, data_ini, data_fim, qtd_dias)
VALUES(1, 1, 1, '2020-07-13', '2020-07-14', 1)

select * from reserva

INSERT INTO reserva(id_func, id_cliente, id_quarto, data_ini, data_fim, qtd_dias)
VALUES(1, 1, 1, '2020-07-13', '2020-07-14', 1)

select * from funcionario

update cliente SET nome = 'Roberta', sexo = 'F'
WHERE id = 1 AND nome = 'Anildo'

DELETE FROM reserva WHERE qtd_dias = 1
DELETE FROM reserva 
WHERE nome='Roberta';

select * from cliente

SELECT cli.nome as 'Cliente', cli.idade, re.qtd_dias, 
			re.data_ini as 'Data de Entrada'
from reserva re
INNER JOIN cliente cli ON cli.id = re.id_cliente

select count(*) as 'Total' from reserva

