-- Creation of 'breedingManagement' database

-- Setting start of commit
SET AUTOCOMMIT = 0;
START TRANSACTION;

-- Deleting database if one exists with the same name
DROP DATABASE
    IF EXISTS breedingManagement;

-- Creating database
CREATE DATABASE breedingManagement
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;
USE breedingManagement;


-- `user` table : login and passwords for users
CREATE TABLE user (
    id_user INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_login VARCHAR(50) NOT NULL,
    user_password VARCHAR(50) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO user (id_user, user_login, user_password)
    VALUES 
    (1, 'admin', 'admin'),
    (2, 'mbon', 'mb');


-- `animal` table : all the animals that are breeded or have been bred
CREATE TABLE animal (
    id_animal INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_breed INT DEFAULT NULL,
    animal_name VARCHAR(30) DEFAULT NULL,
    animal_sex CHAR(1) DEFAULT NULL,
    animal_height DECIMAL DEFAULT NULL,
    animal_weight DECIMAL DEFAULT NULL,
    animal_lifespan INT DEFAULT NULL,
    birth_time TIMESTAMP DEFAULT 0,
    death_time TIMESTAMP DEFAULT 0,
    id_father INT DEFAULT 0,
    id_mother INT DEFAULT 0
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;


-- `breed` table : different breeds of animals
CREATE TABLE breed (
    id_breed INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    breed_name VARCHAR(50) DEFAULT NULL,
    id_animal_specie INT DEFAULT NULL,
    min_avg_lifespan INT DEFAULT NULL,
    max_avg_lifespan INT DEFAULT NULL,
    min_avg_height INT DEFAULT NULL,
    max_avg_height INT DEFAULT NULL,
    min_avg_weight INT DEFAULT NULL,
    max_avg_weight INT DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO breed (
    breed_name, 
    id_animal_specie, 
    min_avg_lifespan, 
    max_avg_lifespan,
    min_avg_height,
    max_avg_height,
    min_avg_weight,
    max_avg_weight
) VALUES 
    ('Ball Python', 1, 7300, 10950, 120, 180, 1200, 1600),
    ('Corn Snake', 1, 3650, 5475, 120, 150, 300, 600),
    ('Boa Constrictor', 1, 7300, 10950, 180, 400, 5000, 9000),
    ('Green Tree Python', 1, 3650, 5475, 120, 180, 1000, 1800),
    ('King Cobra', 1, 3650, 5475, 300, 400, 4000, 6000),
    ('Black Mamba', 1, 3650, 5475, 200, 250, 1800, 3000),
    ('Reticulated Python', 1, 7300, 10950, 180, 730, 45000, 91000),
    ('Garter Snake', 1, 1825, 3650, 50, 70, 100, 300),
    ('Anaconda', 1, 7300, 10950, 450, 600, 27000, 45000),
    ('Gaboon Viper', 1, 3650, 5475, 100, 150, 6500, 13000),
    ('Burmese Python', 1, 7300, 10950, 180, 450, 36000, 68000),
    ('Indian Python', 1, 7300, 10950, 100, 370, 22000, 45000),
    ('Carpet Python', 1, 5475, 7300, 180, 240, 3500, 6000),
    ('Amazon Tree Boa', 1, 3650, 5475, 90, 150, 500, 1000),
    ('Western Hognose Snake', 1, 3650, 5475, 50, 70, 100, 200);


-- `animal_specie` table : references all the animal species
CREATE TABLE animal_specie (
    id_animal_specie INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    specie_name VARCHAR(50) DEFAULT NULL,
    specie_name_plural VARCHAR(50) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO animal_specie (id_animal_specie, specie_name, specie_name_plural)
    VALUES 
    (1, 'snake', 'snakes'),
    (2, 'cat', 'cats');


-- `name_source` table : contains a database of names and sex used to create random animals
CREATE TABLE name_source (
    id_name_source INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name_example VARCHAR(50) DEFAULT NULL,
    sex_example CHAR(1) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO name_source (id_name_source, name_example, sex_example)
VALUES
(1, 'Donald', 'M'),
(2, 'Daisy', 'F'),
(3, 'Michael', 'M'),
(4, 'Christopher', 'M'),
(5, 'Matthew', 'M'),
(6, 'Emily', 'F'),
(7, 'Aiden', 'M'),
(8, 'Emma', 'F'),
(9, 'Ethan', 'M'),
(10, 'Olivia', 'F'),
(11, 'Sophia', 'F'),
(12, 'Liam', 'M'),
(13, 'Isabella', 'F'),
(14, 'Ava', 'F'),
(15, 'Mia', 'F'),
(16, 'Logan', 'M'),
(17, 'Lucas', 'M'),
(18, 'Mason', 'M'),
(19, 'Amelia', 'F'),
(20, 'Charlotte', 'F'),
(21, 'Noah', 'M'),
(22, 'Abigail', 'F'),
(23, 'Elijah', 'M'),
(24, 'Harper', 'F'),
(25, 'Carter', 'M'),
(26, 'Scarlett', 'F'),
(27, 'Avery', 'F'),
(28, 'Jackson', 'M'),
(29, 'Madison', 'F'),
(30, 'Ella', 'F'),
(31, 'Aubrey', 'F'),
(32, 'Henry', 'M'),
(33, 'Addison', 'F'),
(34, 'Lily', 'F'),
(35, 'Chloe', 'F'),
(36, 'Evelyn', 'F'),
(37, 'Ezra', 'M'),
(38, 'Grace', 'F'),
(39, 'Hudson', 'M'),
(40, 'Luna', 'F'),
(41, 'Mila', 'F'),
(42, 'Layla', 'F'),
(43, 'Leo', 'M'),
(44, 'Nora', 'F'),
(45, 'Hazel', 'F'),
(46, 'Riley', 'F'),
(47, 'Zoe', 'F'),
(48, 'Sofia', 'F'),
(49, 'Gabriel', 'M'),
(50, 'Stella', 'F'),
(51, 'Caleb', 'M'),
(52, 'Peyton', 'F'),
(53, 'Xavier', 'M'),
(54, 'Zoe', 'F'),
(55, 'Gabriel', 'M'),
(56, 'Lily', 'F'),
(57, 'Ezra', 'M'),
(58, 'Aria', 'F'),
(59, 'Owen', 'M'),
(60, 'Scarlett', 'F'),
(61, 'Isaac', 'M'),
(62, 'Ellie', 'F'),
(63, 'Benjamin', 'M'),
(64, 'Hannah', 'F'),
(65, 'Lucas', 'M'),
(66, 'Mila', 'F'),
(67, 'Anthony', 'M'),
(68, 'Aubrey', 'F'),
(69, 'Andrew', 'M'),
(70, 'Grace', 'F'),
(71, 'Eli', 'M'),
(72, 'Layla', 'F'),
(73, 'David', 'M'),
(74, 'Zoe', 'F'),
(75, 'Aiden', 'M'),
(76, 'Aurora', 'F'),
(77, 'Mason', 'M'),
(78, 'Zoe', 'F'),
(79, 'James', 'M'),
(80, 'Ella', 'F'),
(81, 'Joseph', 'M'),
(82, 'Aria', 'F'),
(83, 'Jackson', 'M'),
(84, 'Peyton', 'F'),
(85, 'Oliver', 'M'),
(86, 'Madison', 'F'),
(87, 'Carter', 'M'),
(88, 'Chloe', 'F'),
(89, 'Christopher', 'M'),
(90, 'Sofia', 'F'),
(91, 'Daniel', 'M'),
(92, 'Harper', 'F'),
(93, 'Henry', 'M'),
(94, 'Zoe', 'F'),
(95, 'Sebastian', 'M'),
(96, 'Stella', 'F'),
(97, 'Matthew', 'M'),
(98, 'Avery', 'F'),
(99, 'William', 'M'),
(100, 'Emily', 'F'),
(101, 'Aiden', 'M'),
(102, 'Emma', 'F'),
(103, 'Elijah', 'M'),
(104, 'Zoe', 'F'),
(105, 'Owen', 'M'),
(106, 'Scarlett', 'F'),
(107, 'Caleb', 'M'),
(108, 'Aria', 'F'),
(109, 'Benjamin', 'M'),
(110, 'Layla', 'F'),
(111, 'Isaac', 'M'),
(112, 'Ellie', 'F'),
(113, 'Lucas', 'M'),
(114, 'Mila', 'F'),
(115, 'Gabriel', 'M'),
(116, 'Lily', 'F'),
(117, 'Andrew', 'M'),
(118, 'Grace', 'F'),
(119, 'Eli', 'M'),
(120, 'Aubrey', 'F'),
(121, 'David', 'M'),
(122, 'Zoe', 'F'),
(123, 'Aiden', 'M'),
(124, 'Aurora', 'F'),
(125, 'Mason', 'M'),
(126, 'Zoe', 'F'),
(127, 'James', 'M'),
(128, 'Ella', 'F'),
(129, 'Joseph', 'M'),
(130, 'Aria', 'F'),
(131, 'Jackson', 'M'),
(132, 'Peyton', 'F'),
(133, 'Oliver', 'M'),
(134, 'Madison', 'F'),
(135, 'Carter', 'M'),
(136, 'Chloe', 'F'),
(137, 'Christopher', 'M'),
(138, 'Sofia', 'F'),
(139, 'Daniel', 'M'),
(140, 'Harper', 'F'),
(141, 'Henry', 'M'),
(142, 'Zoe', 'F'),
(143, 'Sebastian', 'M'),
(144, 'Stella', 'F'),
(145, 'Matthew', 'M'),
(146, 'Avery', 'F'),
(147, 'William', 'M'),
(148, 'Emily', 'F'),
(149, 'Nathan', 'M'),
(150, 'Hannah', 'F'),
(151, 'Ethan', 'M'),
(152, 'Ava', 'F'),
(153, 'Aiden', 'M'),
(154, 'Olivia', 'F'),
(155, 'Sophia', 'F'),
(156, 'Liam', 'M'),
(157, 'Isabella', 'F'),
(158, 'Ava', 'F'),
(159, 'Mia', 'F'),
(160, 'Logan', 'M'),
(161, 'Lucas', 'M'),
(162, 'Mason', 'M'),
(163, 'Amelia', 'F'),
(164, 'Charlotte', 'F'),
(165, 'Noah', 'M'),
(166, 'Abigail', 'F'),
(167, 'Elijah', 'M'),
(168, 'Harper', 'F'),
(169, 'Carter', 'M'),
(170, 'Scarlett', 'F'),
(171, 'Avery', 'F'),
(172, 'Jackson', 'M'),
(173, 'Madison', 'F'),
(174, 'Ella', 'F'),
(175, 'Aubrey', 'F'),
(176, 'Henry', 'M'),
(177, 'Addison', 'F'),
(178, 'Lily', 'F'),
(179, 'Chloe', 'F'),
(180, 'Evelyn', 'F'),
(181, 'Ezra', 'M'),
(182, 'Grace', 'F'),
(183, 'Hudson', 'M'),
(184, 'Luna', 'F'),
(185, 'Mila', 'F'),
(186, 'Layla', 'F'),
(187, 'Leo', 'M'),
(188, 'Nora', 'F'),
(189, 'Hazel', 'F'),
(190, 'Riley', 'F'),
(191, 'Zoe', 'F'),
(192, 'Sofia', 'F'),
(193, 'Gabriel', 'M'),
(194, 'Stella', 'F'),
(195, 'Caleb', 'M'),
(196, 'Peyton', 'F'),
(197, 'Xavier', 'M'),
(198, 'Zoe', 'F'),
(199, 'Gabriel', 'M'),
(200, 'Lily', 'F');

-- column_label table : label for each column in the database

CREATE TABLE column_label (
    id_column_label VARCHAR(50) NOT NULL PRIMARY KEY,
    label VARCHAR(50) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO column_label (id_column_label, label)
    VALUES 
    ('id_animal', 'ID'),
    ('id_breed', 'Breed ID'),
    ('animal_name', 'Name'),
    ('animal_sex', 'Sex'),
    ('animal_height', 'height'),
    ('animal_weight', 'Weight'),
    ('animal_lifespan', 'Lifespan'),
    ('birth_time', 'Birth'),
    ('death_time', 'Death'),
    ('id_father', 'Father ID'),
    ('id_mother', 'Mother ID'),
    ('breed_name', 'Breed');
    


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


-- Creating a view to generate the content for animal_list.php
CREATE VIEW breedingManagement.animalList AS (SELECT 
                                                id_animal, 
                                                animal_name, 
                                                animal_sex,                                                 
                                                breed_name,
                                                animal_height, 
                                                animal_weight, 
                                                animal_lifespan, 
                                                DATE_FORMAT(birth_time, '%d/%m/%Y %H:%i') AS birth_time
                                                  FROM animal
                                                    INNER JOIN breed
                                                            ON animal.id_breed = breed.id_breed
                                                            WHERE death_time = '0000-00-00 00:00:00');


-- Creating a view to count the number of animals per breed
CREATE VIEW breedingManagement.breedCount AS (
    SELECT 
        breed_name,
        COUNT(id_animal) AS breed_count
    FROM animal
    INNER JOIN breed
        ON animal.id_breed = breed.id_breed
    WHERE death_time = '0000-00-00 00:00:00'
    GROUP BY breed_name
    ORDER BY breed_name ASC
);



-- Creating a stored procedure to generate random animals with optional parameters (amount to create, sex, breed)
DELIMITER //

CREATE PROCEDURE breedingManagement.createRandomAnimals(
    IN numCalls INT,
    IN optionalSex CHAR(1),
    IN optionalBreed INT
)
BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE breedIdExists INT;

    WHILE i <= numCalls DO
        -- Random or specified id_breed
        IF optionalBreed IS NULL THEN
            SET breedIdExists = (SELECT 1 FROM breed ORDER BY RAND() LIMIT 1);
            SELECT id_breed INTO @id_breed FROM breed WHERE breedIdExists = 1 ORDER BY RAND() LIMIT 1;
        ELSE
            SET @id_breed = optionalBreed;
        END IF;

        -- Random animal_name
        SELECT id_name_source INTO @id_name_source FROM name_source ORDER BY RAND() LIMIT 1;
        SELECT name_example INTO @animal_name FROM name_source WHERE id_name_source = @id_name_source;

        -- Random or specified animal_sex
        IF optionalSex IS NULL OR LENGTH(optionalSex) <> 1 THEN
            SELECT sex_example INTO @animal_sex FROM name_source WHERE id_name_source = @id_name_source;
        ELSE
            SET @animal_sex = optionalSex;
        END IF;

        -- Random animal_height
        SELECT min_avg_height INTO @min_avg_height FROM breed WHERE id_breed = @id_breed;
        SELECT max_avg_height INTO @max_avg_height FROM breed WHERE id_breed = @id_breed;
        SELECT FLOOR(@min_avg_height + RAND() * (@max_avg_height - @min_avg_height + 1)) INTO @animal_height;

        -- Random animal_weight
        SELECT min_avg_weight INTO @min_avg_weight FROM breed WHERE id_breed = @id_breed;
        SELECT max_avg_weight INTO @max_avg_weight FROM breed WHERE id_breed = @id_breed;
        SELECT FLOOR(@min_avg_weight + RAND() * (@max_avg_weight - @min_avg_weight + 1)) INTO @animal_weight;

        -- Random animal_lifespan
        SELECT min_avg_lifespan INTO @min_avg_lifespan FROM breed WHERE id_breed = @id_breed;
        SELECT max_avg_lifespan INTO @max_avg_lifespan FROM breed WHERE id_breed = @id_breed;
        SELECT FLOOR(@min_avg_lifespan + RAND() * (@max_avg_lifespan - @min_avg_lifespan + 1)) INTO @animal_lifespan;

        -- Random datetime in the last 7 days
        SELECT DATE_FORMAT(CURRENT_TIMESTAMP() - INTERVAL FLOOR(RAND() * 604800) SECOND, '%Y-%m-%d %H:%i') INTO @birth_time;

        -- Create new animal with random or specified values
        INSERT INTO animal (
            id_breed,
            animal_name,
            animal_sex,
            animal_height,
            animal_weight,
            animal_lifespan,
            birth_time
        )
        VALUES (
            @id_breed,
            @animal_name,
            @animal_sex,
            @animal_height,
            @animal_weight,
            @animal_lifespan,
            @birth_time
        );

        SET i = i + 1;
    END WHILE;

END//

DELIMITER ;


-- Generating 20 random animals to populate the `animal` table
CALL createRandomAnimals(20, NULL, NULL);



-- End of commit
COMMIT;
SET AUTOCOMMIT = 1;