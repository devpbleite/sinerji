create table if not exists empresas (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nome VARCHAR(45) NOT NULL,
  cnpj int unsigned,
  PRIMARY KEY (id),
  UNIQUE KEY (cnpj)
)

create table if not exists empresas_unidades (
  empresa_id int unsigned not null,
  cidade_id int unsigned not null,
  sede TINYINT(1) NOT NULL,
  primary key (empresa_id, cidade_id)
)