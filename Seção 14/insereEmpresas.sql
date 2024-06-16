insert into empresas (nome, cnpj) values
('Bradesco', 12345678912345),
('Vale', 98787654567786),
('Cielo', 76456789123456);

alter table empresas modify cnpj varchar(14);

select * from empresas