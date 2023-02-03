drop table if exists `caixatermica`;
create table `caixatermica` (
    id int not null auto_increment,
    username text not null,
    password text not null,
    primary key (id)
);
insert into `caixatermica` (username, password) values
    ("admin","password"),
    ("Alice","this is my password"),
    ("Job","12345678"),
    ("admin","password"),
    ("Alice","this is my password"),
    ("Job","12345678");
