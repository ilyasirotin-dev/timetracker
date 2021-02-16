create table time_table (
    id int unsigned not null,
    start time,
    end time,
    created_at date,
    foreign key (id) references users(id)
);