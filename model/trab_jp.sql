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
create table clube_modalidade
(
	id INT not null auto_increment primary key,
    nome varchar(100) not null,
    localModalidade varchar(100) not null,
    diaModalidade1 varchar(12) not null,
    diaModalidade2 varchar(12) not null,
    diaModalidade3 varchar(12) not null,
    horarioInicio1 varchar(10),
    horarioTermino1 varchar(10),
    horarioTInicio2 varchar(10),
    horarioTermino2 varchar(10),
    horarioInicio3 varchar(10),
    horarioTermino3 varchar(10),
    data_criacao timestamp default current_timestamp
);
create table atleta_modalidade
(
id_modalidade INT not null,
id_atleta INT not null,
primary key(id_modalidade,id_atleta),
FOREIGN KEY (id_modalidade) REFERENCES clube_modalidade(id),
FOREIGN KEY (id_atleta) REFERENCES clube_atleta(id)
);