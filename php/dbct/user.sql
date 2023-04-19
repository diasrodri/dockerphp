drop table if exists `Exp`;
create table `Exp` (
    id int not null auto_increment,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    t1 FLOAT NOT NULL,
    t2 FLOAT NOT NULL,
    t3 FLOAT NOT NULL,
    cur FLOAT NOT NULL,
    primary key (id)
);
insert into `Exp` (reg_date, t1, t2, t3, cur) values
    (CURRENT_TIMESTAMP,"0.0","0.0","0.0","0.0");
