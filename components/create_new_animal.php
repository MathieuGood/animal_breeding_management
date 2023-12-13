<?php

include_once("../classes/animal.class.php");
include_once("../classes/dbconnect.class.php");

$popup_origin = $_POST['origin'];


if ($popup_origin == 'breeding') {

    $breed = $_POST['id_breed'];
    $id_father = $_POST['id_father'];
    $id_mother = $_POST['id_mother'];

    $animal = new Animal();
    $id_animal = $animal->createRandomAnimal(1, $breed, $id_father, $id_mother);
    $add_image = '<img class="img-fluid" src="images/baby_snake.svg">';
    $add_before_name = 'Welcome to the world ';
    $add_after_name = '!';


} else if ($popup_origin == 'new' || $popup_origin == 'edit') {
    $id_animal = $_POST['id_animal'];
    $add_image = '';
    $add_before_name = ucfirst($_SESSION['animal_specie']).' ';
    
    if ($popup_origin == 'new') {$add_after_name = ' has been successfully created';}
    if ($popup_origin == 'edit') {$add_after_name = ' has been successfully edited';}
}

$animal = new Animal($id_animal);
$animal_name = $animal->getAnimalName();
$add_name = '<span id="snake_name">' . $animal_name . '</span>';

//For debugging
// var_dump($_POST);
?>

<div class="card card-popup text-center mb-3" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">
            <?php
            echo $add_before_name . $add_name . $add_after_name;
            ?>
        </h5><br>
        <?php echo $add_image ?>
        <p class="card-text"></p>
        <a href="index.php?page=animal_list" id="go_back" class="btn btn-primary">Back to animal list</a>
    </div>
</div>