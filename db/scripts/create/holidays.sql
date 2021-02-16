create table holidays (
    id int unsigned not null auto_increment primary key,
    name varchar(64) not null,
    hoiday_date date not null,
    info text,
    created_at date not null,
    set_repeat enum('Y', 'N') default('N')
);