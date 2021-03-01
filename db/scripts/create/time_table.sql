CREATE TABLE time_table (
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT(10) UNSIGNED NOT NULL,
    start BIGINT,
    end BIGINT,
    created_at BIGINT,
    total BIGINT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);