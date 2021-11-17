create table Movie(id int PRIMARY KEY, title varchar(100), year int, rating varchar(10), company varchar(50));
create table Actor(id int PRIMARY KEY, last varchar(20), first varchar(20), sex varchar(6), dob date, dod date);
create table MovieGenre(mid int, genre varchar(20));
create table MovieActor(mid int, aid int, role varchar(50));
create table Review(name varchar(20), time datetime, mid int, rating int, comment text);
