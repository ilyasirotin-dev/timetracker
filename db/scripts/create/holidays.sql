CREATE TABLE holidays (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(160) NOT NULL,
    date BIGINT NOT NULL,
    description LONGTEXT,
    created_at BIGINT NOT NULL,
    repeatable TINYINT(1)
);