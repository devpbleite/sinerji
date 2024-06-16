create table if not exists prefeitos (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nome VARCHAR(45) NOT NULL,
  cidade_id INT UNSIGNED,  
  PRIMARY KEY (id),
  UNIQUE KEY (cidade_id),
  FOREIGN KEY (cidade_id) REFERENCES cidades (id)
);

