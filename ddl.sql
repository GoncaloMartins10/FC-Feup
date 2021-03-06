CREATE TABLE cliente (
    num_socio SERIAL,
    nome VARCHAR(100) NOT NULL,
    morada VARCHAR(200) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    password VARCHAR(100) NOT NULL,
    imagem VARCHAR(200) NOT NULL,
    aprovacao BOOLEAN DEFAULT FALSE,
    admin BOOLEAN DEFAULT FALSE,

    PRIMARY KEY(num_socio)
);

CREATE TABLE encomenda (
    id SERIAL,
    total DECIMAL(10,2) DEFAULT 0,
    num_produtos INTEGER DEFAULT 0,
    data_compra DATE DEFAULT current_date,
    comprado BOOLEAN DEFAULT FALSE,
    clienteID INTEGER,

    PRIMARY KEY (id)
);

CREATE TABLE linha_encomenda (
    id SERIAL,
    quantidade INTEGER,
    tamanho CHAR(5),
    total DECIMAL(10,2),
    produtoID INTEGER,
    encomendaID INTEGER,

    PRIMARY KEY(id)
);

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
    idade INTEGER NOT NULL,
    imagem VARCHAR(200) NOT NULL,

    PRIMARY KEY(num_camisola)
);


ALTER TABLE encomenda
    ADD FOREIGN KEY (clienteID) REFERENCES cliente(num_socio) ON UPDATE CASCADE ON DELETE SET NULL;

ALTER TABLE linha_encomenda
    ADD FOREIGN KEY (encomendaID) REFERENCES encomenda(id) ON UPDATE CASCADE,
    ADD FOREIGN KEY (produtoID) REFERENCES produto(id) ON UPDATE CASCADE ON DELETE CASCADE;