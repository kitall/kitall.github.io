CREATE TABLE cliente (
    id_usuario bigint NOT NULL,
    nome character varying(30) NOT NULL,
    sobrenome character varying(40) NOT NULL,
    cpf character varying(14) NOT NULL,
    sexo character varying(1) NOT NULL,
    data_nasc date NOT NULL,
    telefone character varying(14),
    celular character varying(14),
    excluido character(1) DEFAULT 'n'::bpchar NOT NULL,
    data_exclusao date
);

CREATE TABLE endereco (
    id_endereco integer NOT NULL,
    id_usuario bigint NOT NULL,
    endereco character varying(255) NOT NULL,
    numero character varying(10) NOT NULL,
    complemento character varying(40),
    bairro character varying(255),
    cep character varying(10) NOT NULL,
    cidade character varying(40) NOT NULL,
    estado character varying(2) NOT NULL,
    pais character varying(30) DEFAULT 'Brasil'::character varying NOT NULL,
    excluido character(1) DEFAULT 'n'::bpchar,
    data_exclusao date
);

CREATE TABLE usuario (
    id_usuario bigint NOT NULL,
    login character varying(40) NOT NULL,
    email character varying(40) NOT NULL,
    senha character varying(32) NOT NULL,
    excluido character(1) DEFAULT 'n'::bpchar NOT NULL,
    data_exclusao date,
    valido numeric
);