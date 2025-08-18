create database banco1;

create table clientes(
	id SERIAL primary key,
    nome varchar(60) not null,
    email varchar(60) not null,
    cidade varchar(60) not null,
    estado varchar(60) not null,
    telefone varchar(60) not null
);
create table usuarios(
	id SERIAL primary key,
    login varchar(255) not null,
    senha varchar(255) not null,
    nome varchar(255) not null,
    token varchar(255)
);
insert into usuarios values (
1,
'neto',
'$2y$10$JcEosbNGmuUonm/T7PjlteBDYwfILw3UNYmmTHoW5jYge3P.uDhh2',
'neto frente',
''
);

insert into clientes values (
1,
'Luan',
'luan123@gmail.com',
'aquidauana',
'MS',
'67912345678'
);
insert into clientes values (
2,
'Gusttavo Lima',
'embaixador@gmail.com',
'itumbiara',
'GO',
'679123000000'
);