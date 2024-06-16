insert into cidades (nome, area, estado_id)
values ('Recife', 795, 4);

insert into cidades (nome, area, estado_id)
values ('Salvador', 220, 4);

select * from cidades where estado_id = 4;

insert into cidades (nome, area, estado_id)
values ('Campinas', 134, (select id from estados where sigla = 'SP'));
  

