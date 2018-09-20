/*Script do banco de dados para o projeto de e-commerce*/
DROP TABLE IF EXISTS produtos;
CREATE TABLE produtos
(
    id SERIAL PRIMARY KEY,
    nome CHARACTER VARYING(40) NOT NULL,
    qtd INT NOT NULL,
    preco FLOAT NOT NULL,
    link_img CHARACTER VARYING(100),
    excluido BOOL NOT NULL
);

DROP TABLE IF EXISTS carrinho;
CREATE TABLE carrinho
(
    id_prod INT REFERENCES produtos NOT NULL,
    qtd INT NOT NULL,
    val_total FLOAT NOT NULL
);

DROP TABLE IF EXISTS comprasfeitas;
CREATE TABLE comprasfeitas
(
    id_comrpa SERIAL PRIMARY KEY,
    id_cli INT NOT NULL,
    id_prod INT REFERENCES produtos NOT NULL,
    qtd INT NOT NULL,
    val_total FLOAT NOT NULL,
    excluido BOOL NOT NULL
);
/*--------------------------------------------------------------------------------------*/
DROP TABLE IF EXISTS administradores;
CREATE TABLE administradores
(
    id_adm SERIAL PRIMARY KEY,
    nome CHARACTER VARYING(30),
    senha CHARACTER VARYING(40)
);
INSERT INTO administradores VALUES(DEFAULT, 'Andre Creppe', 'adc49a48a7f2a861702c4306c92244be');