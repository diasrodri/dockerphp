drop table if exists `caixatermica`;
create table `caixatermica` (
    id int not null auto_increment,
    username text not null,
    password text not null,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    val1 FLOAT NOT NULL,
    val2 FLOAT NOT NULL,
    val3 FLOAT NOT NULL,
    primary key (id)
);
insert into `caixatermica` (username, password, reg_date, val1, val2, val3) values
    ("admin","password",CURRENT_TIMESTAMP,"12.97","12.97","12.97"),
    ("Alice","this is my password",CURRENT_TIMESTAMP,"12.97","12.97","12.97"),
    ("Job","12345678",CURRENT_TIMESTAMP,"12.97","12.97","12.97"),
    ("admin","password",CURRENT_TIMESTAMP,"12.97","12.97","12.97"),
    ("Alice","this is my password",CURRENT_TIMESTAMP,"12.97","12.97","12.97"),
    ("Job","12345678",CURRENT_TIMESTAMP,"12.97","12.97","12.97");
