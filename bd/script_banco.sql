/* Script do banco de dados da 'Kitall?' */
DROP TABLE IF EXISTS produtos CASCADE;
CREATE TABLE produtos
(
    id          SERIAL PRIMARY KEY NOT NULL,
    nome        CHARACTER VARYING(40) NOT NULL,
    qtd         INT NOT NULL,
    preco       FLOAT NOT NULL,
    link_img    CHARACTER VARYING(120) NOT NULL,
    descricao   CHARACTER VARYING(300) NOT NULL,
    excluido    BOOL NOT NULL
);

DROP TABLE IF EXISTS carrinho;
CREATE TABLE carrinho
(
    id_cli          INT NOT NULL,
    id_prod         INT REFERENCES produtos NOT NULL,
    qtd             INT NOT NULL,
    preco_total     FLOAT NOT NULL
);

DROP TABLE IF EXISTS comprasfeitas;
CREATE TABLE comprasfeitas
(
    id_comrpa SERIAL    PRIMARY KEY NOT NULL,
    id_usr              INT NOT NULL,
    id_prod             INT REFERENCES produtos NOT NULL,
    qtd                 INT NOT NULL,
    val_total           FLOAT NOT NULL,
    excluido            BOOL NOT NULL
);
/*--------------------------------------------------------------------------------------*/