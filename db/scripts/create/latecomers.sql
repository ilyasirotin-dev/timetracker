CREATE TABLE latecomers (
    user_id INT UNSIGNED NOT NULL PRIMARY KEY,
    created_at BIGINT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);