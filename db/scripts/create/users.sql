create table users (
    id int unsigned not null auto_increment primary key,
    fname varchar(32),
    lname varchar(32),
    username varchar(32) not null,
    email varchar(40) not null,
    role enum("Admin", "User", "Guest") default("Guest"),
    password binary(32),
    active enum('Y', 'N') default('N')
);