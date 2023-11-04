-- Creation of 'breedingManagement' database

SET AUTOCOMMIT = 0;
START TRANSACTION;

DROP DATABASE
    IF EXISTS breedingManagement;
CREATE DATABASE breedingManagement
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;
USE breedingManagement;

-- user table : login and passwords for users

CREATE TABLE user (
    id_user INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_login VARCHAR(50) NOT NULL,
    user_password VARCHAR(50) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO user (id_user, user_login, user_password)
    VALUES 
    (1, 'admin', 'admin'),
    (2, 'mbon', 'mb');

-- animal table : all the animals that are breeded or have been bred

CREATE TABLE animal (
    id_animal INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_breed INT DEFAULT NULL,
    animal_name VARCHAR(30) DEFAULT NULL,
    animal_sex CHAR(1) DEFAULT NULL,
    animal_heigth DECIMAL DEFAULT NULL,
    animal_weight DECIMAL DEFAULT NULL,
    animal_lifespan DECIMAL DEFAULT NULL,
    birth_timestamp TIMESTAMP DEFAULT 0,
    death_timestamp TIMESTAMP DEFAULT 0,
    id_father INT DEFAULT NULL,
    id_mother INT DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO animal (
    id_animal,
    id_breed, 
    animal_name, 
    animal_sex,
    animal_heigth,
    animal_weight, 
    animal_lifespan, 
    birth_timestamp, 
    death_timestamp,
    id_father,
    id_mother
    ) VALUES 
    (1, 1, 'Desmond', 'M', 150, 3.2, 10.5, '2023-10-21 19:30:20', 0, 3, 2),
    (2, 2, 'Mary', 'F', 162, 2.1, 9.1, '2023-10-03 19:00:00', 0, NULL, NULL),
    (3, 2, 'Jasper', 'M', 107, 1.9, 8.5, '2023-10-01 22:11:40', 0, NULL, NULL),
    (4, 2, 'Katy', 'F', 181, 2.0, 8.7, '2023-10-30 05:20:20', 0, 1, 5),
    (5, 1, 'Cindarella', 'F', 165, 3.5, 10.1, '2023-10-19 14:53:00', 0, NULL, NULL);


-- breed table : different breeds of animals

CREATE TABLE breed (
    id_breed INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    breed_name VARCHAR(50) DEFAULT NULL,
    id_animal_specie INT DEFAULT NULL,
    min_avg_lifespan INT DEFAULT NULL,
    max_avg_lifespan INT DEFAULT NULL,
    min_avg_heigth DECIMAL DEFAULT NULL,
    max_avg_heigth DECIMAL DEFAULT NULL,
    min_avg_weight DECIMAL DEFAULT NULL,
    max_avg_weight DECIMAL DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO breed (
    breed_name, 
    id_animal_specie, 
    min_avg_lifespan, 
    max_avg_lifespan,
    min_avg_heigth,
    max_avg_heigth,
    min_avg_weight,
    max_avg_weight
) VALUES 
    ('Ball Python', 1, 7300, 10950, 1.2, 1.8, 1.2, 1.6),
    ('Corn Snake', 1, 3650, 5475, 1.2, 1.5, 0.3, 0.6),
    ('Boa Constrictor', 1, 7300, 10950, 1.8, 4.0, 5, 9),
    ('Green Tree Python', 1, 3650, 5475, 1.2, 1.8, 1, 1.8),
    ('King Cobra', 1, 3650, 5475, 3.0, 4.0, 4, 6),
    ('Black Mamba', 1, 3650, 5475, 2.0, 2.5, 1.8, 3),
    ('Reticulated Python', 1, 7300, 10950, 1.8, 7.3, 45, 91),
    ('Garter Snake', 1, 1825, 3650, 0.5, 0.7, 0.1, 0.3),
    ('Anaconda', 1, 7300, 10950, 4.5, 6.0, 27, 45),
    ('Gaboon Viper', 1, 3650, 5475, 1.0, 1.5, 6.5, 13),
    ('Burmese Python', 1, 7300, 10950, 1.8, 4.5, 36, 68),
    ('Indian Python', 1, 7300, 10950, 1.0, 3.7, 22, 45),
    ('Carpet Python', 1, 5475, 7300, 1.8, 2.4, 3.5, 6),
    ('Amazon Tree Boa', 1, 3650, 5475, 0.9, 1.5, 0.5, 1),
    ('Western Hognose Snake', 1, 3650, 5475, 0.5, 0.7, 0.1, 0.2);



-- animal_specie table : references all the animal species

CREATE TABLE animal_specie (
    id_animal_specie INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    specie_name VARCHAR(50) DEFAULT NULL,
    specie_name_plural VARCHAR(50) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO animal_specie (id_animal_specie, specie_name, specie_name_plural)
    VALUES 
    (1, 'snake', 'snakes'),
    (2, 'cat', 'cats');


-- name_source table : contains a database of names and sex used to create random animals

CREATE TABLE name_source (
    id_name_source INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name_example VARCHAR(50) DEFAULT NULL,
    sex_example CHAR(1) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO name_source (id_name_source, name_example, sex_example)
    VALUES
    (1, 'Donald', 'M'),
    (2, 'Daisy', 'F');


-- column_label table : label for each column in the database

CREATE TABLE column_label (
    id_column_label VARCHAR(50) NOT NULL PRIMARY KEY,
    label VARCHAR(50) DEFAULT NULL,
    html_input_type VARCHAR(50) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO column_label (id_column_label, label, html_input_type)
    VALUES 
    ('id_animal', 'ID', 'text'),
    ('id_breed', 'Breed ID', 'text'),
    ('animal_name', 'Name', 'text'),
    ('animal_sex', 'Sex', 'text'),
    ('animal_heigth', 'Height', 'text'),
    ('animal_weight', 'Weight', 'text'),
    ('animal_lifespan', 'Lifespan', 'text'),
    ('birth_timestamp', 'Birth', 'datetime-local'),
    ('death_timestamp', 'Death', 'datetime-local'),
    ('id_father', 'Father ID', 'text'),
    ('id_mother', 'Mother ID', 'text'),
    ('breed_name', 'Breed', 'text');

-- Set keys

ALTER TABLE animal
    ADD KEY id_animal (id_animal);

ALTER TABLE breed
    ADD KEY id_breed (id_breed);

ALTER TABLE animal_specie
    ADD KEY id_animal_specie (id_animal_specie);

ALTER TABLE user
    ADD KEY id_user (id_user);

ALTER TABLE column_label
    ADD KEY id_column_label (id_column_label);


COMMIT;
SET AUTOCOMMIT = 1;
