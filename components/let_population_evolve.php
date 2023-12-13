<?php

include_once("classes/animal.class.php");
include_once("classes/dbconnect.class.php");

$animal = new Animal();
$animal->letPopulationEvolve();

?>