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
    animal_lifespan INT DEFAULT NULL,
    birth_timestamp TIMESTAMP DEFAULT 0,
    death_timestamp TIMESTAMP DEFAULT 0,
    id_father INT DEFAULT 0,
    id_mother INT DEFAULT 0
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
    (1, 1, 'Desmond', 'M', 150, 3.2, 10, '2023-10-20 19:30:00', 0, 3, 2),
    (2, 2, 'Mary', 'F', 162, 2.1, 9, '2023-10-03 19:00:00', 0, 0, 0),
    (3, 2, 'Jasper', 'M', 107, 1.9, 8, '2023-10-01 22:11:00', 0, 0, 0),
    (4, 5, 'Katy', 'F', 181, 2.0, 8, '2023-10-30 05:20:00', 0, 1, 5),
    (5, 1, 'Cindarella', 'F', 165, 3, 10.1, '2023-10-19 14:53:00', 0, 0, 0);


-- breed table : different breeds of animals

CREATE TABLE breed (
    id_breed INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    breed_name VARCHAR(50) DEFAULT NULL,
    id_animal_specie INT DEFAULT NULL,
    min_avg_lifespan INT DEFAULT NULL,
    max_avg_lifespan INT DEFAULT NULL,
    min_avg_heigth INT DEFAULT NULL,
    max_avg_heigth INT DEFAULT NULL,
    min_avg_weight INT DEFAULT NULL,
    max_avg_weight INT DEFAULT NULL
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
(2, 'Daisy', 'F'),
(3, 'Michael', 'M'),
(4, 'Christopher', 'M'),
(5, 'Matthew', 'M'),
(6, 'Andrew', 'M'),
(7, 'James', 'M'),
(8, 'John', 'M'),
(9, 'Robert', 'M'),
(10, 'William', 'M'),
(11, 'Joseph', 'M'),
(12, 'Daniel', 'M'),
(13, 'David', 'M'),
(14, 'Brian', 'M'),
(15, 'Kevin', 'M'),
(16, 'Thomas', 'M'),
(17, 'Steven', 'M'),
(18, 'Richard', 'M'),
(19, 'Charles', 'M'),
(20, 'Mark', 'M'),
(21, 'Anthony', 'M'),
(22, 'Jeffrey', 'M'),
(23, 'Timothy', 'M'),
(24, 'Scott', 'M'),
(25, 'Ryan', 'M'),
(26, 'Paul', 'M'),
(27, 'Eric', 'M'),
(28, 'Jason', 'M'),
(29, 'Jonathan', 'M'),
(30, 'Jeremy', 'M'),
(31, 'Gregory', 'M'),
(32, 'Adam', 'M'),
(33, 'Benjamin', 'M'),
(34, 'Peter', 'M'),
(35, 'George', 'M'),
(36, 'Kenneth', 'M'),
(37, 'Nicholas', 'M'),
(38, 'Edward', 'M'),
(39, 'Samuel', 'M'),
(40, 'Jerry', 'M'),
(41, 'Raymond', 'M'),
(42, 'Patrick', 'M'),
(43, 'Gary', 'M'),
(44, 'Stephen', 'M'),
(45, 'Dennis', 'M'),
(46, 'Larry', 'M'),
(47, 'Bryan', 'M'),
(48, 'Ronald', 'M'),
(49, 'Douglas', 'M'),
(50, 'Roger', 'M'),
(51, 'Greg', 'M'),
(52, 'Jesse', 'M'),
(53, 'Terry', 'M'),
(54, 'Frank', 'M'),
(55, 'Christian', 'M'),
(56, 'Gerald', 'M'),
(57, 'Ray', 'M'),
(58, 'Joe', 'M'),
(59, 'Phillip', 'M'),
(60, 'Caleb', 'M'),
(61, 'Danny', 'M'),
(62, 'Alan', 'M'),
(63, 'Evan', 'M'),
(64, 'Walter', 'M'),
(65, 'Ethan', 'M'),
(66, 'Harry', 'M'),
(67, 'Fred', 'M'),
(68, 'Wayne', 'M'),
(69, 'Louis', 'M'),
(70, 'Bruce', 'M'),
(71, 'Billy', 'M'),
(72, 'Stanley', 'M'),
(73, 'Willie', 'M'),
(74, 'Jordan', 'M'),
(75, 'Sam', 'M'),
(76, 'Albert', 'M'),
(77, 'Randy', 'M'),
(78, 'Howard', 'M'),
(79, 'Justin', 'M'),
(80, 'Vincent', 'M'),
(81, 'Bob', 'M'),
(82, 'Jeremy', 'M'),
(83, 'Bobby', 'M'),
(84, 'Roy', 'M'),
(85, 'Phillip', 'M'),
(86, 'Alan', 'M'),
(87, 'Juan', 'M'),
(88, 'Harry', 'M'),
(89, 'Eugene', 'M'),
(90, 'Jesse', 'M'),
(91, 'Jim', 'M'),
(92, 'Tom', 'M'),
(93, 'Ronnie', 'M'),
(94, 'Gary', 'M'),
(95, 'Bobby', 'M'),
(96, 'Martin', 'M'),
(97, 'Joe', 'M'),
(98, 'Paul', 'M'),
(99, 'Ron', 'M'),
(100, 'Anthony', 'M'),
(101, 'Ralph', 'M'),
(102, 'Kevin', 'M'),
(103, 'Raymond', 'M'),
(104, 'Carl', 'M'),
(105, 'Roger', 'M'),
(106, 'Joe', 'M'),
(107, 'Michael', 'M'),
(108, 'George', 'M'),
(109, 'Edward', 'M'),
(110, 'Mark', 'M'),
(111, 'Jerry', 'M'),
(112, 'Joshua', 'M'),
(113, 'Matthew', 'M'),
(114, 'James', 'M'),
(115, 'Robert', 'M'),
(116, 'John', 'M'),
(117, 'David', 'M'),
(118, 'William', 'M'),
(119, 'Charles', 'M'),
(120, 'Steven', 'M'),
(121, 'Richard', 'M'),
(122, 'Brian', 'M'),
(123, 'Andrew', 'M'),
(124, 'Jeffrey', 'M'),
(125, 'Timothy', 'M'),
(126, 'Ryan', 'M'),
(127, 'Thomas', 'M'),
(128, 'Scott', 'M'),
(129, 'Paul', 'M'),
(130, 'Eric', 'M'),
(131, 'Jason', 'M'),
(132, 'Jonathan', 'M'),
(133, 'Jeremy', 'M'),
(134, 'Gregory', 'M'),
(135, 'Adam', 'M'),
(136, 'Benjamin', 'M'),
(137, 'Peter', 'M'),
(138, 'Kenneth', 'M'),
(139, 'Nicholas', 'M'),
(140, 'Edward', 'M'),
(141, 'Samuel', 'M'),
(142, 'Jerry', 'M'),
(143, 'Raymond', 'M'),
(144, 'Patrick', 'M'),
(145, 'Gary', 'M'),
(146, 'Stephen', 'M'),
(147, 'Dennis', 'M'),
(148, 'Brandon', 'M'),
(149, 'Cameron', 'M'),
(150, 'Dominic', 'M'),
(151, 'Jennifer', 'F'),
(152, 'Jessica', 'F'),
(153, 'Emily', 'F'),
(154, 'Amanda', 'F'),
(155, 'Sarah', 'F'),
(156, 'Elizabeth', 'F'),
(157, 'Megan', 'F'),
(158, 'Natalie', 'F'),
(159, 'Taylor', 'F'),
(160, 'Hannah', 'F'),
(161, 'Alexis', 'F'),
(162, 'Samantha', 'F'),
(163, 'Ashley', 'F'),
(164, 'Madison', 'F'),
(165, 'Olivia', 'F'),
(166, 'Abigail', 'F'),
(167, 'Isabella', 'F'),
(168, 'Grace', 'F'),
(169, 'Alyssa', 'F'),
(170, 'Brianna', 'F'),
(171, 'Emma', 'F'),
(172, 'Ava', 'F'),
(173, 'Chloe', 'F'),
(174, 'Zoe', 'F'),
(175, 'Sophia', 'F'),
(176, 'Mia', 'F'),
(177, 'Natalie', 'F'),
(178, 'Hailey', 'F'),
(179, 'Ella', 'F'),
(180, 'Scarlett', 'F'),
(181, 'Avery', 'F'),
(182, 'Lily', 'F'),
(183, 'Addison', 'F'),
(184, 'Lillian', 'F'),
(185, 'Grace', 'F'),
(186, 'Nora', 'F'),
(187, 'Evelyn', 'F'),
(188, 'Abigail', 'F'),
(189, 'Emily', 'F'),
(190, 'Sofia', 'F'),
(191, 'Aria', 'F'),
(192, 'Riley', 'F'),
(193, 'Liam', 'F'),
(194, 'Layla', 'F'),
(195, 'Hazel', 'F'),
(196, 'Mila', 'F'),
(197, 'Ella', 'F'),
(198, 'Scarlett', 'F'),
(199, 'Avery', 'F'),
(200, 'Lily', 'F'),
(201, 'Addison', 'F'),
(202, 'Lillian', 'F'),
(203, 'Grace', 'F'),
(204, 'Nora', 'F'),
(205, 'Evelyn', 'F'),
(206, 'Abigail', 'F'),
(207, 'Emma', 'F'),
(208, 'Sophia', 'F'),
(209, 'Isabella', 'F'),
(210, 'Olivia', 'F'),
(211, 'Mia', 'F'),
(212, 'Ava', 'F'),
(213, 'Zoe', 'F'),
(214, 'Natalie', 'F'),
(215, 'Chloe', 'F'),
(216, 'Sofia', 'F'),
(217, 'Aria', 'F'),
(218, 'Riley', 'F'),
(219, 'Liam', 'F'),
(220, 'Layla', 'F'),
(221, 'Hazel', 'F'),
(222, 'Mila', 'F'),
(223, 'Charlotte', 'F'),
(224, 'Emma', 'F'),
(225, 'Sophia', 'F'),
(226, 'Olivia', 'F'),
(227, 'Ava', 'F'),
(228, 'Mia', 'F'),
(229, 'Isabella', 'F'),
(230, 'Riley', 'F'),
(231, 'Aria', 'F'),
(232, 'Zoe', 'F'),
(233, 'Lily', 'F'),
(234, 'Emily', 'F'),
(235, 'Grace', 'F'),
(236, 'Nora', 'F'),
(237, 'Evelyn', 'F'),
(238, 'Abigail', 'F'),
(239, 'Sophia', 'F'),
(240, 'Emma', 'F'),
(241, 'Olivia', 'F'),
(242, 'Ava', 'F'),
(243, 'Mia', 'F'),
(244, 'Isabella', 'F'),
(245, 'Charlotte', 'F'),
(246, 'Amelia', 'F'),
(247, 'Harper', 'F'),
(248, 'Evelyn', 'F'),
(249, 'Abigail', 'F'),
(250, 'Emily', 'F'),
(251, 'Sofia', 'F'),
(252, 'Aria', 'F'),
(253, 'Zoe', 'F'),
(254, 'Riley', 'F'),
(255, 'Liam', 'F'),
(256, 'Layla', 'F'),
(257, 'Hazel', 'F'),
(258, 'Mila', 'F'),
(259, 'Charlotte', 'F'),
(260, 'Emma', 'F'),
(261, 'Sophia', 'F'),
(262, 'Olivia', 'F'),
(263, 'Ava', 'F'),
(264, 'Mia', 'F'),
(265, 'Isabella', 'F'),
(266, 'Riley', 'F'),
(267, 'Aria', 'F'),
(268, 'Zoe', 'F'),
(269, 'Lily', 'F'),
(270, 'Emily', 'F'),
(271, 'Grace', 'F'),
(272, 'Nora', 'F'),
(273, 'Evelyn', 'F'),
(274, 'Abigail', 'F'),
(275, 'Sophia', 'F'),
(276, 'Emma', 'F'),
(277, 'Olivia', 'F'),
(278, 'Ava', 'F'),
(279, 'Mia', 'F'),
(280, 'Isabella', 'F'),
(281, 'Charlotte', 'F'),
(282, 'Amelia', 'F'),
(283, 'Harper', 'F'),
(284, 'Evelyn', 'F'),
(285, 'Abigail', 'F'),
(286, 'Emily', 'F'),
(287, 'Sofia', 'F'),
(288, 'Aria', 'F'),
(289, 'Zoe', 'F'),
(290, 'Riley', 'F'),
(291, 'Liam', 'F'),
(292, 'Layla', 'F'),
(293, 'Hazel', 'F'),
(294, 'Mila', 'F'),
(295, 'Charlotte', 'F'),
(296, 'Samantha', 'F'),
(297, 'Olivia', 'F'),
(298, 'Ella', 'F'),
(299, 'Grace', 'F'),
(300, 'Lily', 'F');


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
    ('animal_heigth', 'Heigth', 'text'),
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


DELIMITER //

CREATE PROCEDURE breedingManagement.createRandomAnimal()
BEGIN

-- Random id_breed
SELECT (SELECT id_breed FROM breed ORDER BY RAND() LIMIT 1) INTO @id_breed;

-- Random animal_name and animal_sex
SELECT (SELECT id_name_source FROM name_source ORDER BY RAND() LIMIT 1) INTO @id_name_source;
SELECT (SELECT name_example FROM name_source WHERE id_name_source = @id_name_source) INTO @animal_name;
SELECT (SELECT sex_example FROM name_source WHERE id_name_source = @id_name_source) INTO @animal_sex;

-- Random animal_heigth
SELECT (SELECT min_avg_heigth FROM breed WHERE id_breed = @id_breed) INTO @min_avg_heigth;
SELECT (SELECT max_avg_heigth FROM breed WHERE id_breed = @id_breed) INTO @max_avg_heigth;
SELECT(FLOOR(@min_avg_heigth + RAND() * (@max_avg_heigth - @min_avg_heigth +1))) INTO @animal_heigth;

-- Random animal_weight
SELECT (SELECT min_avg_weight FROM breed WHERE id_breed = @id_breed) INTO @min_avg_weight;
SELECT (SELECT max_avg_weight FROM breed WHERE id_breed = @id_breed) INTO @max_avg_weight;
SELECT(FLOOR(@min_avg_weight + RAND() * (@max_avg_weight - @min_avg_weight +1))) INTO @animal_weight;

-- Random animal_lifespan
SELECT (SELECT min_avg_lifespan FROM breed WHERE id_breed = @id_breed) INTO @min_avg_lifespan; 
SELECT (SELECT max_avg_lifespan  FROM breed WHERE id_breed = @id_breed) INTO @max_avg_lifespan; 
SELECT(FLOOR(@min_avg_lifespan + RAND() * (@max_avg_lifespan - @min_avg_lifespan +1))) INTO @animal_lifespan;

-- Random datetime in the last 7 days
SELECT (SELECT DATE_FORMAT(CURRENT_TIMESTAMP() - INTERVAL FLOOR(RAND() * 604800) SECOND, '%Y-%m-%d %H:%i')) INTO @birth_timestamp;

-- Create new animal with random values

INSERT INTO animal (
    id_breed, 
    animal_name, 
    animal_sex,
    animal_heigth,
    animal_weight, 
    animal_lifespan, 
    birth_timestamp
    ) 
    VALUES (
        @id_breed,
        @animal_name,
        @animal_sex,
        @animal_heigth,
        @animal_weight,  
        @animal_lifespan,
        @birth_timestamp
     );

END //

DELIMITER ;

COMMIT;
SET AUTOCOMMIT = 1;
