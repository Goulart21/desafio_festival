
create database festival_experiencia_viva_1;
use festival_experiencia_viva_1;

create table participantes(

id_participante int primary key  auto_increment,
nome_participante varchar(100) not null,
email varchar(255) not null unique,
telefone varchar(15) not null,
data_cadasto datetime default current_timestamp

);

create table atividades(

id_atividade int primary key auto_increment,
nome_atividade varchar(100) not null,
descricao varchar(255 ) not null,
data_atividade date not null,
hora_inicio time not null,
hora_fim time not null,
local_atividade varchar(255) not null,
capacidade int not null

);


create table inscricoes(

id_inscricao int primary key auto_increment,
id_participante int not null,
id_atividade int not null,
data_inscricao datetime default current_timestamp,
status enum('ATIVA', 'CANCELADA') default 'ATIVA',

constraint fk_inscricao_participante
foreign key (id_participante) references participantes(id_participante)
on delete cascade,

constraint fk_inscricao_atividade
foreign key (id_atividade) references atividades(id_atividade),

constraint uk_participante_atividade unique(id_participante, id_atividade)

);
