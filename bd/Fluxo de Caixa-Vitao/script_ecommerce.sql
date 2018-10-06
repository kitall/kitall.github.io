DROP TABLE IF EXISTS lancamento;
DROP SEQUENCE IF EXISTS lancamento_id_seq;
CREATE SEQUENCE lancamento_id_seq;
--
CREATE TABLE lancamento
(
	id_lancamento	INTEGER			NOT NULL DEFAULT	NEXTVAL('lancamento_id_seq'),
	dia				DATE			NOT NULL,
	descricao		VARCHAR(30)		NOT NULL,
	tipo			CHARACTER(01)	NOT NULL, -- E=Entrada e S=Saida
	valor			NUMERIC(8,2) 	NOT NULL,
	CONSTRAINT pk_caixa PRIMARY KEY (id_lancamento)
);
--
INSERT INTO lancamento VALUES
(DEFAULT,'02/10/2018','Capital inicial','E',50.00),
(DEFAULT,'05/10/2018','Aquisição de produtos','S',30.00),
(DEFAULT,'09/10/2018','Venda de produtos','E',5.00),
(DEFAULT,'10/10/2018','Venda de produtos','E',10.00),
(DEFAULT,'11/10/2018','Venda de produtos','E',5.00);
--
SELECT * FROM lancamento;
--
DROP TABLE IF EXISTS fluxocaixa;
DROP SEQUENCE IF EXISTS fluxocaixa_id_seq;
CREATE SEQUENCE fluxocaixa_id_seq;
--
CREATE TABLE fluxocaixa
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
--
INSERT INTO fluxocaixa (id_fluxocaixa, dia, descricao, saldoant, entrada, saida, saldoatual)
				SELECT
					l.id_lancamento,
					l.dia,
					l.descricao,
					0.00,
					CASE -- Verifica entradas
						WHEN
							tipo = 'E'
						THEN
							valor
						ELSE
							0.00
					END AS entrada, 
					CASE -- Verifica saidas
							WHEN
								tipo = 'S'
							THEN
								valor
							ELSE
								0.00
					END AS saida, 
					0.00
				FROM
					lancamento l;
--
SELECT * FROM fluxocaixa;
--
SELECT
	id_fluxocaixa,
	TO_CHAR(dia,'DD-MM-YYYY') As dia,
	descricao,
	CASE WHEN lag(saldo,1) over () IS NULL -- Define o saldo anterior
		THEN
			0.00
		ELSE
			lag(saldo,1) over()
		END AS sandoanterior,
	entrada,
	saida,
	saldo as saldoatual
FROM
	(SELECT
	 	b.id_fluxocaixa,
	 	b.dia,
	 	b.descricao,
	 	b.entrada,
	 	b.saida,
	 	SUM(a.entrada) - SUM(a.saida) AS saldo
	 FROM
	 	fluxocaixa a, fluxocaixa b
	 WHERE
	 	a.id_fluxocaixa <= b.id_fluxocaixa
	 GROUP BY b.id_fluxocaixa, b.dia, b.entrada, b.saida
	 ORDER BY b.dia) AS fluxocaixa_tmp;

