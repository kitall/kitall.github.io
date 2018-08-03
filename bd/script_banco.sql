/*Script do banco de dados para o projeto de e-commerce*/
DROP TABLE IF EXISTS e01.produtos;
CREATE TABLE e01.produtos
(
    id SERIAL PRIMARY KEY,
    nome CHARACTER VARYING(40) NOT NULL,
    qtd INT NOT NULL,
    preco FLOAT NOT NULL,
    link_img CHARACTER VARYING(100),
    excluido BOOL NOT NULL
);

DROP TABLE IF EXISTS e01.clientes;
CREATE TABLE e01.clientes
(
    id SERIAL PRIMARY KEY,
    nome CHARACTER VARYING(20) NOT NULL,
    sobrenome CHARACTER VARYING(40) NOT NULL,
    nascm DATE NOT NULL,
    email CHARACTER VARYING(60) NOT NULL,
    cpf BIGINT NOT NULL UNIQUE,
    tel BIGINT,
    senha CHARACTER VARYING(30) NOT NULL,
    adm BOOL NOT NULL,
    excluido BOOL NOT NULL
);

DROP TABLE IF EXISTS e01.carrinho;
CREATE TABLE e01.carrinho
(
    id_prod INT REFERENCES e01.clientes NOT NULL,
    qtd INT NOT NULL,
    val_total FLOAT NOT NULL
);

DROP TABLE IF EXISTS e01.comprasfeitas;
CREATE TABLE e01.comprasfeitas
(
    id_comrpa SERIAL,
    id_cli INT REFERENCES e01.clientes NOT NULL,
    id_prod INT REFERENCES e01.produtos NOT NULL,
    qtd INT NOT NULL,
    val_total FLOAT NOT NULL,
    excluido BOOL NOT NULL
);