-- Creation of 'breedingManagement' database

SET AUTOCOMMIT = 0;
START TRANSACTION;

DROP DATABASE
    IF EXISTS breedingManagement;
CREATE DATABASE breedingManagement
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;
USE breedingManagement;


-- animal table : all the animals that are breeded or have been bred

CREATE TABLE animal (
    id_animal INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_breed INT DEFAULT NULL,
    animal_name VARCHAR(30) DEFAULT NULL,
    animal_sex CHAR(1) DEFAULT NULL,
    animal_weight DECIMAL DEFAULT NULL,
    animal_lifespan DECIMAL DEFAULT NULL,
    birth_timestamp TIMESTAMP DEFAULT NULL,
    death_timestamp TIMESTAMP DEFAULT NULL,
    id_father INT DEFAULT NULL,
    id_mother INT DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO animal (
    id_animal,
    id_breed, 
    animal_name, 
    animal_sex, 
    animal_weight, 
    animal_lifespan, 
    birth_timestamp, 
    death_timestamp,
    id_father,
    id_mother
    ) VALUES 
    (1, 1, 'Desmond', 'M', 3.2, 10.5, '2023-10-21 19:30:20', NULL, 3, 2),
    (2, 2, 'Mary', 'F', 2.1, 9.1, '2023-10-03 19:00:00', NULL, NULL, NULL),
    (3, 2, 'Jasper', 'M', 1.9, 8.5, '2023-10-01 22:11:40', NULL, NULL, NULL),
    (4, 2, 'Katy', 'F', 2.0, 8.7, '2023-10-30 05:20:20', NULL, 1, 5),
    (5, 1, 'Cindarella', 'F', 3.5, 10.1, '2023-10-19 14:53:00', NULL, NULL, NULL);


-- breed table : different breeds of animals

CREATE TABLE breed (
    id_breed INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    breed_name VARCHAR(50) DEFAULT NULL,
    id_animal_specie INT DEFAULT NULL,
    min_avg_lifespan DECIMAL DEFAULT NULL,
    max_avg_lifespan DECIMAL DEFAULT NULL,
    min_avg_weight DECIMAL DEFAULT NULL,
    max_avg_weight DECIMAL DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO breed (
    id_breed, 
    breed_name, 
    id_animal_specie, 
    min_avg_lifespan, 
    max_avg_lifespan,
    min_avg_weight,
    max_avg_weight
    ) VALUES
    (1, 'Ball Python', 1, 10, 30, 1, 2),
    (2, 'Corn Snake', 1, 15, 20, 0.5, 1.5),
    (3, 'Boa Constrictor', 1, 20, 30, 5, 15),
    (4, 'Reticulated Python', 1, 15, 25, 10, 30),
    (5, 'King Snake', 1, 15, 20, 0.3, 1),
    (6, 'Hognose Snake', 1, 7, 18, 0.1, 0.5),
    (7, 'Green Tree Python', 1, 15, 25, 0.5, 1.5),
    (8, 'Anaconda', 1, 10, 30, 20, 100),
    (9, 'Garter Snake', 1, 5, 10, 0.1, 0.5),
    (10, 'Milk Snake', 1, 10, 20, 0.3, 1),
    (11, 'Burmese Python', 1, 20, 30, 20, 60),
    (12, 'Coral Snake', 1, 5, 10, 0.1, 0.3);


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


-- Set keys

ALTER TABLE animal
    ADD KEY id_animal (id_animal);

ALTER TABLE breed
    ADD KEY id_bredd (id_breed);

ALTER TABLE animal_specie
    ADD KEY id_animal_specie (id_animal_specie);


COMMIT;
SET AUTOCOMMIT = 1;