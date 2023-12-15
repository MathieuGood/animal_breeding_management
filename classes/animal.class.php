<?php

class Animal
{

    private $table = "animal";
    private $id;
    private $db_connect;

    public function __construct($id = '')
    {
        $this->id = $id;
        $this->db_connect = new dbConnect();
    }


    public function getAllFilteredAndSortedAnimals($sort, $name_filter, $breed_filter, $sex_filter, $limit, $offset, $alive)
    {

        if ($alive == true) {
            $view = 'animalList';
        } else {
            $view = 'deceasedAnimalList';
        }

        $query = "SELECT * 
                    FROM " . $view . " 
                    WHERE `animal_name` LIKE '%" . $name_filter . "%' 
                    AND `breed_name` LIKE '%" . $breed_filter . "%' 
                    AND `animal_sex` LIKE '%" . $sex_filter . "%'
                    ORDER BY " . $sort . " 
                    LIMIT " . $limit . " OFFSET " . $offset;
        // echo '<br/>';
        // echo '<br/>getAllFilteredAndSortedAnimals';
        // var_dump($query);
        return $this->db_connect->sendQuery(
            $query,
            "num"
        );
    }

    public function getAllFilteredAndSortedBreeds($name_filter, $breed_filter, $sex_filter, $alive)
    {

        if ($alive == false) {
            $death_parameter = '!';
        } else {
            $death_parameter = '';
        }

        $query = "    SELECT breed_name, COUNT(id_animal) AS breed_count
                        FROM animal
                        INNER JOIN breed
                                ON animal.id_breed = breed.id_breed
                                WHERE death_time " . $death_parameter . "= '0000-00-00 00:00:00'
                                  AND `animal_name` LIKE '%" . $name_filter . "%'
                                  AND `breed_name` LIKE '%" . $breed_filter . "%'
                                  AND `animal_sex` LIKE '%" . $sex_filter . "%'
                                    GROUP BY breed_name
                                        ORDER BY breed_name ASC";
        // echo '<br/>';
        // echo '<br/>getAllFilteredAndSortedBreeds';
        // var_dump($query);
        return $this->db_connect->sendQuery(
            $query,
            "num"
        );
    }

    public function getAllFilteredAndSortedSex($name_filter, $breed_filter, $sex_filter, $alive)
    {

        if ($alive == false) {
            $death_parameter = '!';
        } else {
            $death_parameter = '';
        }

        $query = "    SELECT animal_sex, COUNT(id_animal) AS sex_count
                        FROM animal
                        INNER JOIN breed
                                ON animal.id_breed = breed.id_breed
                                WHERE death_time " . $death_parameter . "= '0000-00-00 00:00:00'
                                    AND `animal_name` LIKE '%" . $name_filter . "%'
                                    AND `breed_name` LIKE '%" . $breed_filter . "%'
                                    AND `animal_sex` LIKE '%" . $sex_filter . "%'
                                        GROUP BY animal_sex
                                            ORDER BY breed_name ASC";
        // echo '<br/>';
        // echo '<br/>getAllFilteredAndSortedSex';
        // var_dump($query);
        return $this->db_connect->sendQuery(
            $query,
            "num"
        );
    }

    public function countAllFilteredAndSortedAnimals($sort, $name_filter, $breed_filter, $sex_filter, $alive)
    {

        if ($alive == false) {
            $view = 'deceasedAnimalList';
        } else {
            $view = 'animalList';
        }

        $query = "SELECT COUNT(*) AS animal_count
                    FROM " . $view . "
                    WHERE `animal_name` LIKE '%" . $name_filter . "%' 
                    AND `breed_name` LIKE '%" . $breed_filter . "%' 
                    AND `animal_sex` LIKE '%" . $sex_filter . "%' 
                    ORDER BY " . $sort;
        return $this->db_connect->sendQuery(
            $query,
            "num"
        )[0]['animal_count'];
    }


    // Get breed IDs and names based on animals population in animal table
    public function getCurrentBreeds()
    {
        $query = "SELECT animal.id_breed, breed_name
                    FROM animal
                    INNER JOIN breed
                            on animal.id_breed = breed.id_breed
                    WHERE death_time = '0000-00-00 00:00:00'
                    GROUP BY breed_name
                    ORDER BY breed_name";
        return $this->db_connect->sendQuery($query);
    }

    public function getAllAnimalBreeds()
    {
        return $this->db_connect->sendQuery("SELECT id_breed, breed_name FROM `breed`");
    }


    public function getAllPossibleParentAnimalNames($sex, $choice)
    {
        // If the animal exists (edit animal), exclude it from the list of possible parents
        // Not needed if creating a new animal
        if ($choice != 'new') {
            $exclude_id1 = "AND `id_animal` != '" . $this->id . "'";
            $exclude_id2 = "AND `birth_time` < (SELECT birth_time 
                                                  FROM `" . $this->table .
                "` WHERE `id_" . $this->table . "` = '" . $this->id . "')
                AND `id_breed` = (SELECT id_breed 
                                    FROM $this->table
                                    WHERE id_animal = '" . $this->id . "')";
        }

        $query = "SELECT id_animal, animal_name
                    FROM `" . $this->table .
            "` WHERE `animal_sex` ='" . $sex . "'"
            . $exclude_id1 . "AND `death_time` = '0000-00-00 00:00:00'" . $exclude_id2;

        return $this->db_connect->sendQuery($query);
    }

    // Get all compatible parteners for breeding
    // Filter animals based on sex
    public function getAllCompatiblePartners($sex, $id = '', $id_breed = '')
    {
        if ($id != '') {
            // If animal id is provided, filter partners that share the same breed and exclude the animal itself
            $breed_query = "AND `id_animal` != '" . $id . "'"
                . "AND `animal`.id_breed = (SELECT id_breed 
                                        FROM `" . $this->table .
                "` WHERE `id_" . $this->table . "` = '" . $id . "')";
        } else {
            // If no animal id is provided, exclude no animal
            $breed_query = "AND animal.id_breed = '" . $id_breed . "'";

        }

        $query = "SELECT id_animal, animal_name, breed_name, DATE_FORMAT(birth_time, '%d/%m/%Y %H:%i') AS birth_time
                    FROM `" . $this->table . "`
                    INNER JOIN `breed`
                            ON `" . $this->table . "`.id_breed = `breed`.id_breed
                                WHERE `animal_sex` ='" . $sex . "'
                                AND `death_time` = '0000-00-00 00:00:00'"
            . $breed_query;

        return $this->db_connect->sendQuery($query);
    }


    public function getAnimalDetails($id = '')
    {
        if ($id == '') {
            $id = $this->id;
        }

        return $this->db_connect->sendQuery("SELECT *,
                                        DATE_FORMAT(birth_time, '%d/%m/%Y %H:%i') AS birth_time_formatted,
                                        DATE_FORMAT(death_time, '%d/%m/%Y %H:%i') AS death_time_formatted
                                        FROM `" . $this->table . "` 
                                        INNER JOIN breed ON animal.id_breed=breed.id_breed 
                                        WHERE `id_" . $this->table . "` = " . $id)[0];
    }


    public function getParentDetails($parent_type, $id = '')
    {
        if ($id == '') {
            $id = $this->id;
        }

        $query = "CALL getParentDetails(" . $id . ", '" . $parent_type . "');";

        $result = $this->db_connect->sendQuery($query);
        if (isset($result) && $result != []) {
            return $result[0];
        }
    }


    public function getChildrenDetails($id = '')
    {
        if ($id == '') {
            $id = $this->id;
        }

        $query = "CALL getChildrenDetails(" . $id . ");";

        $result = $this->db_connect->sendQuery($query)[0];
        if (isset($result)) {
            return $result;
        }
    }



    // Get animal_name from id
    public function getAnimalName()
    {
        $result = $this->db_connect->sendQuery("SELECT `animal_name` FROM `" . $this->table . "` WHERE id_" . $this->table . " = '" . $this->id . "'");
        return $result[0]['animal_name'];
    }

    public function getBreedName($id_breed)
    {
        $result = $this->db_connect->sendQuery("SELECT `breed_name` FROM `breed` WHERE id_breed = '" . $id_breed . "'");
        return $result[0]['breed_name'];
    }

    public function update($col, $value)
    {
        return $this->db_connect->update($this->table, $this->id, $col, $value);
    }

    public function createCustomAnimal($cols, $values)
    {
        return $this->db_connect->insertMultiple($this->table, $cols, $values);
    }

    // Create one (default) or several (int as parameter) new random animal
    // with data consistent with its breed characteristics,
    // specifying sex and breed as parameters,
    // using the createRandomAnimal() stored procedure in database
    public function createRandomAnimal($number = 1, $id_breed = 'NULL', $id_father = 0, $id_mother = 0)
    {
        if ($number == '' or $number > 1000) {
            $number = 0;
        }
        // Calling procedure with NULL for animal_sex and id_breed to have complete random animal
        $query = 'CALL createRandomAnimals(' . $number . ', ' . $id_breed . ', ' . $id_father . ', ' . $id_mother . ');';

        return $this->db_connect->sendQuery($query);
    }


    public function declareDead($death_time)
    {
        return $this->db_connect->sendQuery("UPDATE `" . $this->table . "` SET `death_time` = '" . $death_time . "' WHERE `id_" . $this->table . "` = " . $this->id);
    }


    public function countAllAnimalsBySex($alive)
    {
        if ($alive == false) {
            $death_parameter = '!';
        } else {
            $death_parameter = '';
        }

        $query = "SELECT animal_sex, COUNT(*) as count
                    FROM `" . $this->table . "` 
                        WHERE death_time " . $death_parameter . "= '0000-00-00 00:00:00'
                            GROUP BY animal_sex";

        return $this->db_connect->sendQuery($query);
    }


    public function getColumnNames($view)
    {
        return $this->db_connect->getColumnNames($view);
    }


    // Build one html animal presentation card for genealogy display
    // Input value $animal_data is the return of getAnimalDetails, getParentDetails, getChildrenDetails
    public function buildAnimalCard($animal_data, $image = '')
    {
        // Check if there is data
        if ($animal_data) {

            // If a family side is specified, include it and capitalize the string
            if (isset($animal_data['family_side'])) {
                $family_side = '<br>' . ucfirst($animal_data['family_side']) . '\'s side';
            } else {
                $family_side = '';
            }

            // If a relative name is specified, include it and capitalize the string
            if (isset($animal_data['relative'])) {
                $relative = ucfirst($animal_data['relative']);
            } else {
                $relative = '';
            }

            if ($family_side != '' || $relative != '') {
                $add_header = '
                <p class="card-text card-topinfo">
                ' . $relative . '
                ' . $family_side . '        
                </p>
                ';
            } else {
                $add_header = '';
            }

            if ($image != '') {
                $add_image = '<div class="card-topinfo"><img src="' . $image . '" class="card-custom-img img-fluid"></div>';
            } else {
                $add_image = '';
            }

            if ($animal_data['death_time'] != '00/00/0000 00:00') {
                $add_death_time = '<li>Death :
                                ' . $animal_data['death_time'] . '
                                </li>';
            } else {
                $add_death_time = '';
            }


            echo '
        <div class="animal-card card text-center mb-3 mx-2">
        <div class="card-body p-0 pt-1">

                ' . $add_header . '
                ' . $add_image . '        
            
            <h5 class="card-title">
                <span id="snake_name">
                ' . $animal_data['animal_name'] . '
                </span>
            </h5>

            <p class="card-text">

            <ul>

                <li>Birth :
                    ' . $animal_data['birth_time'] . '
                </li>

                ' . $add_death_time . '

            </ul>

            </p>

        </div>
    </div>
        ';

        }

    }

    public function letAnimalsMate($number_of_offspring = 1)
    {
        $query = "CALL createRandomMating(" . $number_of_offspring . ");";
        $this->db_connect->sendQuery($query);
    }

    public function letAnimalsDie()
    {
        $query = "CALL setDeathTime();";
        $this->db_connect->sendQuery($query);
    }

}

?>