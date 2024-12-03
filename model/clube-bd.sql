create database if not exists clube;
use clube;
create table clube_admin(
	id INT not null auto_increment primary key,
    email varchar (100) not null unique,
    senha varchar (255) not null
);
insert into clube_admin(email,senha) values ("joao@gmail.com", "123");
create table clube_atleta(
	id INT not null auto_increment primary key,
    nome varchar(100) not null,
    sobrenome varchar(100) not null,
    avaliacao varchar(100) not null,
    email varchar (100) not null unique,
    senha varchar (255) not null,
    data_criacao timestamp default current_timestamp
);
select * from clube_atleta;
drop database clube;