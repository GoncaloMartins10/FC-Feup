CREATE SCHEMA IF NOT EXISTS fcfeup
SET search_path TO fcfeup

CREATE TABLE produto (
    id SERIAL,
    nome VARCHAR(100) NOT NULL,
    descricao VARCHAR(500),
    imagem VARCHAR(200) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    stock INTEGER NOT NULL,

    PRIMARY KEY(id)
);

CREATE TABLE jogador(
    num_camisola INTEGER UNIQUE NOT NULL,
    nome VARCHAR(100) NOT NULL,
    posicao VARCHAR(12) NOT NULL,
    idade INTEGER,

    PRIMARY KEY(num_camisola)
);

CREATE TABLE linha_encomenda (
    id SERIAL,
    quantidade INTEGER,
    tamanho CHAR,
    total DECIMAL(10,2),
    produtoID INTEGER,

    PRIMARY KEY(id),
    FOREIGN KEY(produtoID) REFERENCES produto(id) ON DELETE CASCADE
);

CREATE TABLE encomenda (
    id SERIAL,
    total DECIMAL(10,2) DEFAULT 0,
    num_produtos INTEGER DEFAULT 0,
    data_entrega DATE,
    comprado BOOLEAN DEFAULT FALSE,
    linha_encomendaID INTEGER,

    PRIMARY KEY (id),
    FOREIGN KEY(linha_encomendaID) REFERENCES linha_encomenda(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE cliente (
    num_socio SERIAL,
    nome VARCHAR(100) NOT NULL,
    morada VARCHAR(200) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    password VARCHAR(20) NOT NULL,
    imagem VARCHAR(200) NOT NULL,
    aprovacao BOOLEAN DEFAULT FALSE,
    admin BOOLEAN DEFAULT FALSE,
    encomendaID INTEGER NOT NULL,

    PRIMARY KEY(num_socio),
    FOREIGN KEY(encomendaID) REFERENCES encomenda(id) ON DELETE CASCADE ON UPDATE CASCADE
);