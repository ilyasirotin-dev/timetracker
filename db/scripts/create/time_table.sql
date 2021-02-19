CREATE TABLE time_table (
    user_id INT(10) UNSIGNED NOT NULL,
    start BIGINT,
    end BIGINT,
    created_at BIGINT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);