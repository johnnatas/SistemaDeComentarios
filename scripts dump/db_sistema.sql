create database db_sistema
default character set utf8
default collate utf8_general_ci;

use db_sistema;

create table users
(
	idusers int not null auto_increment,
    nome varchar(155) not null,
    email varchar(75) not null,
    senha varchar(75) not null,
    foto varchar (45) default 'perfil-default.png',
		primary key(idusers)    
) default charset = utf8;

create table coments
(
	idcoments int not null auto_increment,
    dscomentario mediumtext not null,
    dtcomentario datetime(0) not null default NOW(),
    status_edicao boolean default false,
    idusers int not null,
    constraint pk_coments
		primary key(idcoments),
	constraint fk_coments_users
        foreign key(idusers) 
			references users(idusers)
			on update no action
			on delete no action
)default charset = utf8;

create table editions
(
	idedition int not null auto_increment,
    idcoments int not null,
    dtedition datetime(0) default NOW(),
    dsedition mediumtext,
    status_edition boolean not null default false,
    constraint pk_edition
		primary key(idedition),
	constraint fk_edition_coments
		foreign key(idcoments) 
			references coments(idcoments)
            on update no action
            on delete no action
) default charset = utf8;