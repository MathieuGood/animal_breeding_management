<?php

class Animal
{

    private $table = "animal";
    private $id;

    public function __construct($id = '')
    {
        $this->id = $id;
    }

    public function getAllLiveAnimals()
    {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery(
            "SELECT *
               FROM `" . $this->table . "` 
               WHERE death_time = '0000-00-00 00:00:00' 
               ORDER BY id_animal DESC",
            "num"
        );
    }

    public function getAllFilteredAndSortedAnimals($sort, $name_filter, $breed_filter, $sex_filter, $limit, $offset)
    {
        $db_connect = new dbConnect();
        $query = "SELECT * 
                    FROM animalList 
                    WHERE `animal_name` LIKE '%" . $name_filter . "%' 
                    AND `breed_name` LIKE '%" . $breed_filter . "%' 
                    AND `animal_sex` LIKE '%" . $sex_filter . "%'
                    ORDER BY " . $sort . " 
                    LIMIT " . $limit . " OFFSET " . $offset;
        var_dump($query);
        return $db_connect->sendQuery(
            $query,
            "num"
        );
    }

    public function getAllFilteredAndSortedBreeds($name_filter, $breed_filter, $sex_filter)
    {
        $db_connect = new dbConnect();
        $query = "    SELECT breed_name, COUNT(id_animal) AS breed_count
                        FROM animal
                        INNER JOIN breed
                                ON animal.id_breed = breed.id_breed
                                WHERE death_time = '0000-00-00 00:00:00'
                                  AND `animal_name` LIKE '%" . $name_filter . "%'
                                  AND `breed_name` LIKE '%" . $breed_filter . "%'
                                  AND `animal_sex` LIKE '%" . $sex_filter . "%'
                                    GROUP BY breed_name
                                        ORDER BY breed_name ASC";
        var_dump($query);
        return $db_connect->sendQuery(
            $query,
            "num"
        );
    }

    public function countAllFilteredAndSortedAnimals($sort, $name_filter, $breed_filter, $sex_filter)
    {
        $db_connect = new dbConnect();
        $query = "SELECT COUNT(*) AS animal_count
                    FROM animalList 
                    WHERE `animal_name` LIKE '%" . $name_filter . "%' 
                    AND `breed_name` LIKE '%" . $breed_filter . "%' 
                    AND `animal_sex` LIKE '%" . $sex_filter . "%' 
                    ORDER BY " . $sort;
        return $db_connect->sendQuery(
            $query,
            "num"
        )[0]['animal_count'];
    }

    public function getAllDeadAnimals()
    {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery("SELECT * FROM `" . $this->table . "` WHERE death_time != '0000-00-00 00:00:00'", "num");
    }

    public function getAnimalBreeds()
    {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery("SELECT id_breed, breed_name FROM `breed`");
    }

    public function getAllAliveAnimalsAndParentsBySex($sex)
    {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery("SELECT id_animal, animal_name, id_father, id_mother FROM animal WHERE animal_sex = '" . $sex . "' AND death_time = '0';");
    }

    public function getAllPossibleParentAnimalNames($sex)
    {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery(
            "SELECT id_animal, animal_name
               FROM `" . $this->table . "` 
                WHERE `animal_sex` ='" . $sex . "' 
                AND `id_animal` != '" . $this->id . "' 
                AND `death_time` = '0000-00-00 00:00:00' 
                AND `birth_time` < (SELECT birth_time 
                                            FROM `" . $this->table . "` 
                                            WHERE `id_" . $this->table . "` = '" . $this->id . "')"
        );
    }

    public function getCurrentAnimalData()
    {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery("SELECT * FROM `" . $this->table . "` WHERE `id_" . $this->table . "` = " . $this->id)[0];
    }

    // Get animal_name from id
    public function getAnimalName()
    {
        $db_connect = new dbConnect();
        $result = $db_connect->sendQuery("SELECT `animal_name` FROM `" . $this->table . "` WHERE id_" . $this->table . " = '" . $this->id . "'");
        return $result[0]['animal_name'];
    }

    public function getBreedName($id_breed)
    {
        $db_connect = new dbConnect();
        $result = $db_connect->sendQuery("SELECT `breed_name` FROM `breed` WHERE id_breed = '" . $id_breed . "'");
        return $result[0]['breed_name'];
    }

    public function update($col, $value)
    {
        $db_connect = new dbConnect();
        return $db_connect->update($this->table, $this->id, $col, $value);
    }

    public function createAnimal($cols, $values)
    {
        $db_connect = new dbConnect();
        return $db_connect->insertMultiple($this->table, $cols, $values);
    }

    // Create one (default) or several (int as parameter) new random animal
    // with data consistent with its breed characteristics
    // using the createRandomAnimal() stored procedure in database
    public function createRandomAnimal($number = 1)
    {
        $db_connect = new dbConnect();
        if ($number == '' or $number > 100000) {
            $number = 0;
        }
        return $db_connect->sendQuery('CALL createRandomAnimals(' . $number . ');');
    }

    public function declareDead($death_time)
    {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery("UPDATE `" . $this->table . "` SET `death_time` = '" . $death_time . "' WHERE `id_" . $this->table . "` = " . $this->id);
    }


    public function countAllAliveAnimalsBySex($sex)
    {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery(
            "SELECT COUNT(*) as count
                FROM `" . $this->table . "` 
                WHERE death_time = '0000-00-00 00:00:00'
                AND animal_sex='" . $sex . "'"
        )[0]['count'];
    }


    public function getColumnNames()
    {
        $db_connect = new dbConnect();
        return $db_connect->getColumnNames('animalList');
    }
}


?>