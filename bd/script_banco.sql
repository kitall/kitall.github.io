/* Script do banco de dados de PRODUTOS da 'Kitall?' */
DROP TABLE IF EXISTS p_produtos CASCADE;
DROP TABLE IF EXISTS p_carrinho;
DROP TABLE IF EXISTS p_vendas;

CREATE TABLE p_produtos
(
    id_prod     SERIAL PRIMARY KEY NOT NULL,
    nome        CHARACTER VARYING(40) NOT NULL,
    qtd         INT NOT NULL,
    preco       FLOAT NOT NULL,
    custo       FLOAT NOT NULL,
    descricao   CHARACTER VARYING(300) NOT NULL,
    link_img    CHARACTER VARYING(120) NOT NULL,
    excluido    BOOL NOT NULL
);

CREATE TABLE p_carrinho
(
    id_cli          INT NOT NULL,
    id_prod         INT NOT NULL
                        REFERENCES p_produtos,
    qtd             INT NOT NULL,
    preco_prod      FLOAT NOT NULL
);

CREATE TABLE p_vendas
(
    id_venda            SERIAL PRIMARY KEY NOT NULL,
    id_usr              INT NOT NULL,
    id_prod             INT NOT NULL
                            REFERENCES p_produtos,
    qtd                 INT NOT NULL,
    preco_prod          FLOAT NOT NULL,
    data_venda          DATE NOT NULL,
    excluido            BOOL NOT NULL
);
/*-----------------------------------------------------------------------------------------*/
/* Script do banco de dados de CLIENTES da 'Kitall?' */
DROP TABLE IF EXISTS c_endereco;
DROP SEQUENCE IF EXISTS endereco_id_endereco_seq;
DROP TABLE IF EXISTS c_cliente;
DROP TABLE IF EXISTS c_usuario;
DROP SEQUENCE IF EXISTS usuario_id_usuario_seq;


CREATE SEQUENCE usuario_id_usuario_seq;
CREATE TABLE c_usuario
(
    id_usuario      BIGINT          NOT NULL    DEFAULT NEXTVAL('usuario_id_usuario_seq'),
    login           VARCHAR(40)     NOT NULL    UNIQUE,
    email           VARCHAR(40)     NOT NULL    UNIQUE,
    senha           VARCHAR(32)     NOT NULL,
    excluido        CHARACTER(01)   NOT NULL    DEFAULT 'n',
    data_exclusao   DATE,
    valido          NUMERIC,
    CONSTRAINT pk_usuario PRIMARY KEY (id_usuario)
);

CREATE TABLE c_cliente
(
    id_usuario      BIGINT          NOT NULL,
    nome            VARCHAR(30)     NOT NULL,
    sobrenome       VARCHAR(40)     NOT NULL,
    sexo            VARCHAR(01)     NOT NULL,
    data_nasc       DATE            NOT NULL,
    telefone        VARCHAR(15),
    celular         VARCHAR(15),
    excluido        CHARACTER(01)   NOT NULL    DEFAULT 'n',
    data_exclusao   DATE,
    CONSTRAINT pk_cliente PRIMARY KEY (id_usuario),
    CONSTRAINT fk_cliente FOREIGN KEY (id_usuario) REFERENCES c_usuario(id_usuario)
);

CREATE SEQUENCE endereco_id_endereco_seq;
CREATE TABLE c_endereco
(
    id_endereco     BIGINT          NOT NULL    DEFAULT NEXTVAL('endereco_id_endereco_seq'),
    id_usuario      BIGINT          NOT NULL,
    endereco        VARCHAR(255)    NOT NULL,
    numero          VARCHAR(10)     NOT NULL,
    complemento     VARCHAR(40),
    bairro          VARCHAR(255),
    cep             VARCHAR(10)     NOT NULL,
    cidade          VARCHAR(40)     NOT NULL,
    estado          VARCHAR(02)     NOT NULL    DEFAULT 'SP',
    pais            VARCHAR(30)     NOT NULL    DEFAULT 'Brasil',
    excluido        CHARACTER(01)               DEFAULT 'n'::bpchar,
    data_exclusao   DATE,
    CONSTRAINT pk_endereco PRIMARY KEY (id_endereco),
    CONSTRAINT fk_endereco FOREIGN KEY (id_usuario) REFERENCES c_usuario(id_usuario)
);
/*-----------------------------------------------------------------------------------------*/

must doo
INSERT INTO blabla VALUES (
    DEFAULT, kelvin, kenvin@arroba.com, senha, DEFAULT,
    NULL -- data exclusao
    false -- excluido
)