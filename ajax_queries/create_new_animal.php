<?php

include_once("../classes/animal.class.php");
include_once("../classes/dbconnect.class.php");

$breed = $_POST['id_breed'];
$id_father = $_POST['id_father'];
$id_mother = $_POST['id_mother'];

var_dump($_POST);



$animal = new Animal();

$new_animal = $animal->createRandomAnimal(1, $breed, $id_father, $id_mother);


?>