create database login;
use login;
create table usuarios(id int auto_increment primary key, usuario , password varchar(50));
insert into usuarios(usuario, password) values('administrador', md5('123456'));
insert into usuarios(usuario, password) values('usuario', md5('123456'));