CREATE DATABASE BookComments
go

USE BookComments
go

CREATE TABLE BK_tbUsuario(
	idUsuario int primary key identity(1,1),
	nome varchar(60) not null,
	email varchar(60) not null,
	senha varchar(255) not null,
	permissao char(1) not null
)
CREATE TABLE BK_tbAutor(
	idAutor int primary key identity(1,1),
	nome varchar(60),
	sobre varchar(max),
	foto varchar(255)
)
CREATE TABLE BK_tbSinopse(
	idSinopse int primary key identity(1,1),
	sinopse varchar(max)
)
CREATE TABLE BK_tbLivro(
	idLivro int primary key identity(1,1),
	idAutor int references BK_tbAutor(idAutor),--
        idSinopse int references BK_tbSinopse(idSinopse),
	titulo varchar(100) not null,
	Capa varchar(255),
	Lancamento int,
	edicao tinyint,
	volume tinyint,
	numPag int,
	situacao char(1)
)


SELECT * FROM BK_tbAutor
SELECT * FROM BK_tbUsuario
SELECT * FROM BK_tbSinopse
SELECT * FROM BK_tbLivro

/*
DELETE TABLE BK_tbAutor
DELETE TABLE BK_tbUsuario
DELETE TABLE BK_tbSinopse
DELETE TABLE BK_tbLivro

DROP DATABASE BookComments
*/
