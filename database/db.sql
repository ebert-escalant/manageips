create database bdsicodiec;
use bdsicodiec;

create table users (
id bigint(20) unsigned not null auto_increment,
name varchar(255) not null,
email varchar(255) unique not null,
email_verified_at timestamp null,
password varchar(255) not null,
primary key (id)
)engine=InnoDB;

create table offices (
id bigint(20) unsigned not null auto_increment,
name varchar(255) not null,
area varchar(255) not null,
primary key (id)
)engine=InnoDB;

create table staffs (
id bigint(20) unsigned not null auto_increment,
dni char(8) not null,
fullname varchar(255) not null,
charge varchar(50) not null,
office_id bigint(20) unsigned not null,
foreign key (office_id) references offices(id),
primary key (id)
)engine=InnoDB;

create table networks (
id bigint(20) unsigned not null auto_increment,
ip varchar(15) not null,
mask varchar(15) not null,
gateway varchar(15) not null
primary key (id)
)engine=InnoDB;

create table  devices (
id bigint(20) unsigned not null auto_increment,
mac char(17) not null,
brand varchar(50) not null,
model varchar(50) not null,
type varchar(50) not null,
description varchar(255) not null,
staff_id bigint(20) unsigned not null,
office_id bigint(20) unsigned not null,
network_id bigint(20) unsigned not null,
user_id bigint(20) unsigned not null,
foreign key (staff_id) references staffs(id),
foreign key (office_id) references offices(id),
foreign key (network_id) references networks(id),
foreign key (user_id) references users(id),
primary key (id)
)engine=InnoDB;

insert into users(name, email, password) values ('Admin', 'admin@gmail.com', '$2y$12$Pm7alsHzEayogPPYizA2i.karRVMZRu1cguVaNP9lH/th1BAEtRbu');