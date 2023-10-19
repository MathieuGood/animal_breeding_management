# Système de gestion de cheptel de serpents

![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white) ![CSS3](https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white) ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white) ![MariaDB](https://img.shields.io/badge/MariaDB-003545?style=for-the-badge&logo=mariadb&logoColor=white)


## Technologies utilisées

Ce site utilise PHP et une base de données MariaDB, il devra donc être hébergé sur une infrastructure adaptée.


## Base de données

### Création de la base

La création de la base de données ainsi que des tables nécessaires se fait par l'intermédiaire du script `create_cheptel.sql` qui peut être exécuté directement dans phpMyAdmin. Le script contient quelques données pour alimenter la base et ainsi tester le fonctionnement du site.

### Connexion à la base

Les informations de connexion à la base de donnée doivent être directement modifiées dans la fonction `__construct` du fichier `bdd.class.php` où
- `$h` est le nom de domaine du serveur
- `$db` est le nom de la base de données
- `$u` est le nom d'utilisateur
- `$pw` est le mot de passe
```php
public function __construct($h='localhost', $db='espaceDjango', $u='mariadb', $pw='mariadb*1')
```
