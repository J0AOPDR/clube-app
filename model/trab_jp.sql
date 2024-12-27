create database if not exists clube;
use clube;
create table clube_admin(
 
	id INT not null auto_increment primary key,
    email varchar (100) not null unique,
	senha varchar (255) not null
 
);

insert into clube_admin(email,senha) values ("joao@gmail.com", "123");
 
create table clube_modalidade
(
	id int not null auto_increment primary key,
    nome_modalidade varchar(100),
    localModalidade varchar(100) not null,
    data_criacao timestamp default current_timestamp
 
);
delimiter //
CREATE TRIGGER tr_altera_modalidade
before update
on clube_modalidade
for each row
begin
 
update clube_atleta set id_modalidade = new.id where id_modalidade = old.id;
update modalidade_estatistica set id_modalidade = new.id where id_modalidade = old.id;
update modalidade_horario set id_modalidade = new.id where id_modalidade = old.id;
 
end //

delimiter ;

create table clube_atleta(
 
	id INT not null auto_increment primary key,
    nome varchar(100) not null,
    sobrenome varchar(100) not null,
    avaliacao varchar(100) not null,
    email varchar (100) not null unique,
    id_modalidade int not null,
    senha varchar (255) not null,
    data_criacao timestamp default current_timestamp,
    foreign key (id_modalidade) references clube_modalidade(id)
	
    
);

create table modalidade_estatistica
(
	id_modalidade int primary key not null,
    vitorias int,
    derrotas int,
    empates int,
    foreign key (id_modalidade) references clube_modalidade(id)
);
create table modalidade_horario
(
	id_modalidade int primary key not null,
    dia varchar(20) not null,
    inicio varchar (20) not null,
    termino varchar(20) not null,
	foreign key (id_modalidade) references clube_modalidade(id)
);
CREATE TABLE notificacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mensagem TEXT NOT NULL,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
);

 
select * from modalidade_estatistica;
select * from modalidade_horario;
select * from clube_modalidade;

select * from clube_atleta;
