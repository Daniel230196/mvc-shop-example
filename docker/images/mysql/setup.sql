CREATE DATABASE main;
USE main;
CREATE TABLE IF NOT EXISTS user(
    id INT unique auto_increment,
    login VARCHAR(60) unique,
    password VARCHAR(200),
    email varchar(150),
    phone varchar(10)
);