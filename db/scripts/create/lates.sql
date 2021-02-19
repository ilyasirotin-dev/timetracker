CREATE TABLE lates (
    user_id INT(10) UNSIGNED NOT NULL,
    created_at BIGINT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);