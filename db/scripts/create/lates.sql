create table lates (
    id int unsigned not null,
    created_at date default(now()),
    foreign key (id) references users(id)
);