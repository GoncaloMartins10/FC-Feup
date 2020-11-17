CREATE TABLE cliente (
    num_socio SERIAL,
    nome VARCHAR(100) NOT NULL,
    morada VARCHAR(200) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    password VARCHAR(20) NOT NULL,
    imagem VARCHAR(200) NOT NULL,
    aprovacao BOOLEAN DEFAULT FALSE,
    admin BOOLEAN DEFAULT FALSE
);

CREATE TABLE encomenda (
    id SERIAL,
    total DECIMAL(10,2) DEFAULT 0,
    num_produtos INTEGER DEFAULT 0,
    data_entrega DATE,
    comprado BOOLEAN DEFAULT FALSE
);

CREATE TABLE linha_encomenda (
    id SERIAL,
    quantidade INTEGER,
    tamanho CHAR,
    total DECIMAL(10,2)
);

CREATE TABLE produto (
    id SERIAL,
    nome VARCHAR(100) NOT NULL,
    descricao VARCHAR(500),
    imagem VARCHAR(200) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    stock INTEGER NOT NULL
);

CREATE TABLE jogador(
    num_camisola INTEGER UNIQUE NOT NULL,
    nome VARCHAR(100) NOT NULL,
    posicao VARCHAR(12) NOT NULL,
    idade INTEGER,
);