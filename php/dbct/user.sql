drop table if exists `caixatermica`;
create table `caixatermica` (
    id int not null auto_increment,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    t1 FLOAT NOT NULL,
    t2 FLOAT NOT NULL,
    t3 FLOAT NOT NULL,
    cur FLOAT NOT NULL,
    primary key (id)
);
insert into `caixatermica` (reg_date, t1, t2, t3, cur) values
    (CURRENT_TIMESTAMP,"12.97","12.97","12.97","12.97"),
    (CURRENT_TIMESTAMP,"12.97","12.97","12.97","12.97"),
    (CURRENT_TIMESTAMP,"12.97","12.97","12.97","12.97"),
    (CURRENT_TIMESTAMP,"12.97","12.97","12.97","12.97"),
    (CURRENT_TIMESTAMP,"12.97","12.97","12.97","12.97"),
    (CURRENT_TIMESTAMP,"12.97","12.97","12.97","12.97");
