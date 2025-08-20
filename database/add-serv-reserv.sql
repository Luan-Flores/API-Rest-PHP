create table servicos(
	id SERIAL primary key,
    nome varchar(225) not null,
    duracao integer not null, 
    preco decimal(10,2) not null,
    ativo boolean DEFAULT true
);
create table reservas(
    id SERIAL primary key,
    idCliente integer not null,
    idServico integer not null,
    dataHora timestamp not null,
    mensagem varchar(225),
    status varchar(50) default 'Pendente',
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idCliente) REFERENCES clientes(id) ON DELETE CASCADE,
    FOREIGN KEY (idServico) REFERENCES servicos(id) ON DELETE CASCADE
);
