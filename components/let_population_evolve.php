<?php

// Page to be called from bash script to let the population evolve

include_once("classes/animal.class.php");
include_once("classes/dbconnect.class.php");

$animal = new Animal();

// Set the animals that have exceeeded their lifespan to dead (add death_time)
$animal->letAnimalsDie();

// Generate matings for the animals that are alive
// Parameter : number of matings to generate
$animal->letAnimalsMate(2);

?>