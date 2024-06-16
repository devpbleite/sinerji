select * from estados

select sigla, nome from estados
where regiao = 'Sul'

select nome, regiao from estados
where populacao >= 1
order by populacao desc