CREATE TABLE users (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(160),
    lname VARCHAR(160),
    username VARCHAR(80) not null,
    email VARCHAR(120) not null,
    is_admin TINYINT(1),
    password VARCHAR(256),
    created_at BIGINT,
    active TINYINT(1)
);