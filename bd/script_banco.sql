/* Script do banco de dados de PRODUTOS da 'Kitall?' */
DROP TABLE IF EXISTS p_produtos CASCADE;
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
/* Script do banco de dados de FLUXO DE CAIXA da 'Kitall?' */
DROP TABLE IF EXISTS f_lancamento;
DROP SEQUENCE IF EXISTS lancamento_id_seq;

CREATE SEQUENCE lancamento_id_seq;
CREATE TABLE f_lancamento
(
	id_lancamento	INTEGER			NOT NULL DEFAULT	NEXTVAL('lancamento_id_seq'),
	dia				DATE			NOT NULL,
	descricao		VARCHAR(30)		NOT NULL,
	tipo			CHARACTER(01)	NOT NULL, -- E=Entrada e S=Saida
	valor			NUMERIC(8,2) 	NOT NULL,
	CONSTRAINT pk_caixa PRIMARY KEY (id_lancamento)
);

DROP TABLE IF EXISTS f_fluxocaixa;
DROP SEQUENCE IF EXISTS fluxocaixa_id_seq;

CREATE SEQUENCE fluxocaixa_id_seq;
CREATE TABLE f_fluxocaixa
(
	id_fluxocaixa	INTEGER			NOT NULL DEFAULT	NEXTVAL('fluxocaixa_id_seq'),
	dia				DATE			NOT NULL,
	descricao		VARCHAR(30)		NOT NULL,
	saldoant		NUMERIC(8,2)	NOT NULL,
	entrada			NUMERIC(8,2) 	NOT NULL,
	saida			NUMERIC(8,2)	NOT NULL,
	saldoatual		NUMERIC(8,2)	NOT NULL,
	CONSTRAINT pk_fluxocaixa PRIMARY KEY (id_fluxocaixa)
);

INSERT INTO f_lancamento VALUES(DEFAULT, '04-10-2018', 'Capital inicial', 'E', '50.00');
INSERT INTO f_fluxocaixa VALUES(DEFAULT, '04-10-2018', 'Capital inicial', '0.00', '50.00', '0.00', '50.00');
/*-----------------------------------------------------------------------------------------*/