/*Script do banco de dados para o projeto de e-commerce*/
DROP TABLE IF EXISTS produtos;
CREATE TABLE produtos
(
    id SERIAL PRIMARY KEY,
    nome CHARACTER VARYING(40) NOT NULL,
    qtd INT NOT NULL,
    preco FLOAT NOT NULL,
    link_img CHARACTER VARYING(100),
    descricao CHARACTER VARYING(200) NOT NULL,
    excluido BOOL NOT NULL
);

DROP TABLE IF EXISTS carrinho;
CREATE TABLE carrinho
(
    id_cli INT NOT NULL,
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