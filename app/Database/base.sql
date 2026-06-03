    create database if not exists import default character set utf8mb4 collate utf8mb4_general_ci;
    use import;

    create table users (
        id int not null auto_increment primary key,
        nom varchar(255) not null,
        prenom varchar(255) not null,
        email varchar(255) not null,
        filiere varchar(255) not null,
        niveau varchar(255) not null  
    ) engine=InnoDB default charset=utf8mb4 collate=utf8mb4_general_ci;
