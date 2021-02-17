create table time_table (
    user_id int unsigned not null,
    start time,
    end time,
    created_at date,
    foreign key (user_id) references users(id)
);