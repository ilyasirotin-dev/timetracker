create table lates (
    user_id int unsigned not null,
    created_at date default(now()),
    foreign key (user_id) references users(id)
);