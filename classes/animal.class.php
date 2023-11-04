<?php

class Animal {

    private $table = "animal";
    private $id;

    public function __construct($id='') {
        $this->id = $id;
    }
    
    public function get($col) {
        $db_connect = new dbConnect();
        return $db_connect->select($this->table, $this->id, $col);
    }

    public function getAllAnimals() {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery("SELECT * FROM `".$this->table."`", "num");
    }

    public function getAnimalBreeds() {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery("SELECT id_breed, breed_name FROM `breed`");
    }

    public function getAllAnimalNames($sex) {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery("SELECT id_animal, animal_name FROM `".$this->table."` WHERE `animal_sex` ='".$sex."' AND id_animal != '".$this->id."'");
    }

    public function getAnimalData() {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery("SELECT * FROM `".$this->table."` WHERE `id_".$this->table."` = ".$this->id)[0];
    }

    // Get animal_name from id
    public function getAnimalName() {
        $db_connect = new dbConnect();
        $result = $db_connect->sendQuery("SELECT `animal_name` FROM `".$this->table."` WHERE id_".$this->table." = '".$this->id."'");
        return $result[0]['animal_name'];
    }

    public function getBreedName($id_breed) {
        $db_connect = new dbConnect();
        $result = $db_connect->sendQuery("SELECT `breed_name` FROM `breed` WHERE id_breed = '".$id_breed."'");
        return $result[0]['breed_name'];
    }

    public function update($col, $value) {
        $db_connect = new dbConnect();
        return $db_connect->update($this->table, $this->id, $col, $value);
    }

    public function declareDead($death_timestamp) {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery("UPDATE `".$this->table."` SET `death_timestamp` = '".$death_timestamp."' WHERE `id_".$this->table."` = ".$this->id);
    }

    public function delete($id) {
        $db_connect = new dbConnect();
        $query = "DELETE FROM `".$this->table."` WHERE `id_".$this->table."` = '".$id."'";
        $db_connect->sendQuery($query);
    }

    public function countAnimals() {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery("SELECT COUNT(*) as count_table FROM `".$this->table."`");
    }



    public function selectAll() {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery("SELECT * FROM `".$this->table."`");
    }

    public function getColumnNames() {
        $db_connect = new dbConnect();
        return $db_connect->getColumnNames($this->table);
    }

    public function getColumnNamesAndInputType() {
        $db_connect = new dbConnect();
        return $db_connect->getColumnNamesAndInputType($this->table);
    }
}


?>