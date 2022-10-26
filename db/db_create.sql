use f38_dg06;
/*  please use include "dbconnect.php" to connect to database.
    It will make easier to change database name, user name on different workstation.
    Admin username - admin
    Admin password - fashionspot*/
create table users 
(
    username varchar(50) not null primary key,
    password varchar(100) not null,
    email varchar(50) not null,
    contact varchar(10),
    address text,
    postal varchar(10)
);

create table products
(   productname char(50) not null primary key,
    producttag char(50) not null,
    productprice float unsigned not null,
    productimage char(100)
);

insert into products values 
("Clothing 1", "Dry-Fit", 12.00, "www.google.com"),
("Clothing 2", "Casual", 15.50, "www.google.com"),
("Clothing 4", "Dry-Fit", 13.00, "www.google.com");


insert into users(username, password, email) values 
('admin', md5('fashionspot'), 'admin@fashionspot.com');