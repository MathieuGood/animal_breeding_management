# Animal Breeding Manager

![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white) ![CSS3](https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white) ![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)
 ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white) ![MariaDB](https://img.shields.io/badge/MariaDB-003545?style=for-the-badge&logo=mariadb&logoColor=white)

## Overview

This is a web application to manage an Animal Breeding. It helps you keep you track of the animals along with their data.

Features include :

- Data for each animal
- Name
- Breed
- Height
- Weight
- Lifespan
- Birth date
- Death date
- Father
- Mother

![Animal List](./readme_media/animal_list_screenshot.png)

## Run the app

This web application uses PHP and has to be run on a PHP server.

## Databse

A MySQL/MariaDB server is required to host the database.

### Set up the database

Run the SQL script `createDB_breedingManager.sql` through your PHPMyAdmin interface or with other means.

### Enter your credentials

Your login information to the database can be filled in the `__construct` function in `bdd.class.php` where:

- `$h` is the domain name
- `$db` is the name of your database
- `$u` is the username
- `$pw` is the password

```php
public function __construct($h='localhost', $db='breedingManager', $u='user_name', $pw='password')
```
