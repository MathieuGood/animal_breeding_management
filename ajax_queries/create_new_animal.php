<?php

include_once("../classes/animal.class.php");
include_once("../classes/dbconnect.class.php");

$breed = $_POST['id_breed'];
$id_father = $_POST['id_father'];
$id_mother = $_POST['id_mother'];

//For debugging
// var_dump($_POST);



$animal = new Animal();

$new_animal = $animal->createRandomAnimal(1, $breed, $id_father, $id_mother);

$animal = new Animal($new_animal);

$animal_name = $animal->getAnimalName();

?>

<div class="card text-center mb-3" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">Welcome to the world
            <span id="snake_name">
                <?php echo $animal_name ?>
            </span>
            !
        </h5><br>
        <img class="img-fluid" src="images/baby_snake.svg">
        <p class="card-text"></p>
        <a href="index.php?page=breed_animals" id="go_back" class="btn btn-primary">Back to breeding</a>
    </div>
</div>