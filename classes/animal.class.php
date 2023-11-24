<?php

class Animal
{

    private $table = "animal";
    private $id;

    public function __construct($id = '')
    {
        $this->id = $id;
    }

    public function getAllAnimals()
    {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery("SELECT * FROM `" . $this->table . "`", "num");
    }

    public function getAllLiveAnimals()
    {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery(
            "SELECT *
               FROM `" . $this->table . "` 
               WHERE death_timestamp = '0000-00-00 00:00:00' 
               ORDER BY id_animal DESC",
            "num"
        );
    }

    public function getAllFilteredAndSortedAnimals($sort, $name_filter, $breed_filter, $sex_filter, $limit_start, $limit_end)
    {
        $db_connect = new dbConnect();
        $query = "SELECT * 
                    FROM `" . $this->table . "` 
                    WHERE `animal_name` LIKE '%" . $name_filter . "%' 
                    AND `id_breed` LIKE '%" . $breed_filter . "%' 
                    AND `animal_sex` LIKE '%" . $sex_filter . "%' 
                    ORDER BY " . $sort. " 
                    LIMIT " . $limit_start . ", " . $limit_end;
        return $db_connect->sendQuery(
            $query,
            "num"
        );
    }

    public function countAllFilteredAndSortedAnimals($sort, $name_filter, $breed_filter, $sex_filter)
    {
        $db_connect = new dbConnect();
        $query = "SELECT COUNT(*) AS animal_count
                    FROM `" . $this->table . "` 
                    WHERE `animal_name` LIKE '%" . $name_filter . "%' 
                    AND `id_breed` LIKE '%" . $breed_filter . "%' 
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
        return $db_connect->sendQuery("SELECT * FROM `" . $this->table . "` WHERE death_timestamp != '0000-00-00 00:00:00'", "num");
    }

    public function getAnimalBreeds()
    {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery("SELECT id_breed, breed_name FROM `breed`");
    }

    public function getAllAliveAnimalsAndParentsBySex($sex)
    {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery("SELECT id_animal, animal_name, id_father, id_mother FROM animal WHERE animal_sex = '" . $sex . "' AND death_timestamp = '0';");
    }

    public function getAllPossibleParentAnimalNames($sex)
    {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery(
            "SELECT id_animal, animal_name
               FROM `" . $this->table . "` 
                WHERE `animal_sex` ='" . $sex . "' 
                AND `id_animal` != '" . $this->id . "' 
                AND `death_timestamp` = '0000-00-00 00:00:00' 
                AND `birth_timestamp` < (SELECT birth_timestamp 
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

    // Creates a new random animal with data consistent with its breed characteristics
    // Using the createRandomAnimal() stored procedure in database
    public function createRandomAnimal($number = 1)
    {
        $db_connect = new dbConnect();
        if ($number == '' or $number > 100000) {
            $number = 0;
        }
        echo 'CALL createRandomAnimals(' . $number . ');';
        return $db_connect->sendQuery('CALL createRandomAnimals(' . $number . ');');
    }

    public function declareDead($death_timestamp)
    {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery("UPDATE `" . $this->table . "` SET `death_timestamp` = '" . $death_timestamp . "' WHERE `id_" . $this->table . "` = " . $this->id);
    }

    public function delete($id)
    {
        $db_connect = new dbConnect();
        $query = "DELETE FROM `" . $this->table . "` WHERE `id_" . $this->table . "` = '" . $id . "'";
        $db_connect->sendQuery($query);
    }

    public function countAllAliveAnimalsBySex($sex)
    {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery(
            "SELECT COUNT(*) as count
                FROM `" . $this->table . "` 
                WHERE death_timestamp = '0000-00-00 00:00:00'
                AND animal_sex='".$sex."'")[0]['count'];
    }



    public function selectAll()
    {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery("SELECT * FROM `" . $this->table . "`");
    }

    public function getColumnNames()
    {
        $db_connect = new dbConnect();
        return $db_connect->getColumnNames($this->table);
    }

    public function getColumnNamesAndInputType()
    {
        $db_connect = new dbConnect();
        return $db_connect->getColumnNamesAndInputType($this->table);
    }
}


?>