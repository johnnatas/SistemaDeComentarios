insert into users values
/*
(default, 'Mayara Moraes', 'may_moraes@hotmail.com', 'Florz1nha', default),
(default, 'Gustavo Lima', 'gustavolima@outlook.com', 'astroNAUTA', default),
(default, 'Dafne Souza', 'dada.souza100@hotmail.com', 'minhasenha', default),
(default, 'Ana Mariana', 'anajoana@outlook.com', 'hueBrasil55', default),
(default, 'Kevin Oliveira', 'kevinkevin.ol@gmail.com', 'artigo157', default);
*/
(default, 'Mayara Moraes', 'may_moraes@hotmail.com', '2913e97a6dcbe306660e458887b2158bb477c531', default),
(default, 'Gustavo Lima', 'gustavolima@outlook.com', 'de84ebe5e3e733199a8817aa40b2a0394fccab60', default),
(default, 'Dafne Souza', 'dada.souza100@hotmail.com', '619b59d6d910606a667f896562a26540d2164909', default),
(default, 'Ana Mariana', 'anajoana@outlook.com', '5fdb524ca469cb8d089df30365f320fcb68e50f9', default),
(default, 'Kevin Oliveira', 'kevinkevin.ol@gmail.com', '69b5e80779906a63ef0526b7f5e8457a1ab64f27', default);

create view comentario(nome, comentario, idcomentario, foto, dataComentario, statusEdicao, email) as
SELECT u.nome, c.dscomentario, c.idcoments, u.foto, c.dtcomentario, c.status_edicao, u.email
FROM coments as c inner join users as u
WHERE c.idusers = u.idusers
ORDER BY c.dtcomentario DESC;

select * from users;
select * from comentario;

insert into coments values
(default, 'Vamos ver no que vai dar, espero que seja bom...', now(), default, 1),
(default, 'Mal vejo a hora de comprar hehe', now(), default, 2),
(default, 'Tenho que comprar um, com certeza vou comprar um', now(), default, 3),
(default, 'Razoável, não é grande coisa, esperava mais', now(), default, 4),
(default, 'Pra que vou comprar isso? não vejo a necessidade kkk', now(), default, 5);