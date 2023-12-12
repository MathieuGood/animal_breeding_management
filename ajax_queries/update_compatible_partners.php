<?php

include_once("../classes/animal.class.php");
include_once("../classes/dbconnect.class.php");

$animal = new Animal();

$breed = $_POST['breed'];

?>

<div class="col-auto d-flex justify-content-center flex-column align-items-center">

    <img class="img-fluid" src="images/snake_looking_right.svg"
        style="width:150px; display:flex; flex-diretion:column;">

    <select name='male_animal' id='select_male' value="---" <?php if ($breed == '')
        echo 'disabled' ?>>
            <option>Select male animal</option>
            <?php
    // Get the list of all male animal names
    $males = $animal->getAllCompatiblePartners('M', '', $breed);

    foreach ($males as $male) {
        echo '<option value="' . $male['id_animal'] . '">
                #' . $male['id_animal'] . ' ' . $male['animal_name'] . ' > ' . $male['breed_name'] .
            '</option>';
    }
    ?>

    </select>

</div>

<div class="col-2 d-flex justify-content-center" id="heart-main">

    <div class="heart-container text-center">
        <div class="heart-box">
            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 497 470" height="100%" id="heart">
                <path
                    d="M140 20C73 20 20 74 20 140c0 135 136 170 228 303 88-132 229-173 229-303 0-66-54-120-120-120-48 0-90 28-109 69-19-41-60-69-108-69z"
                    stroke-width="20" fill="none" />
                <defs>
                    <radialGradient id="radialGradient" cx="50%" cy="50%" r="100%" gradientUnits="objectBoundingBox">
                        <stop offset="1%" style="stop-color:rgb(255, 121, 198); stop-opacity:1"></stop>
                        <stop offset="90%" style="stop-color:rgb(255, 121, 198); stop-opacity:1"></stop>
                        <stop offset="100%" style="stop-color:rgb(255, 121, 198); stop-opacity:1"></stop>
                    </radialGradient>
                </defs>
                <style type="text/css">
                    #heart {
                        stroke: url(#radialGradient)
                    }
                </style>
            </svg>
        </div>
    </div>

</div>


<div class="col-auto d-flex justify-content-center flex-column align-items-center">

    <img class="img-fluid" src="images/snake_looking_left.svg" style="width:150px; display:flex; flex-diretion:column;">

    <select name='female_animal' id='select_female' value="---" <?php if ($breed == '')
        echo 'disabled' ?>>
            <option value='0'>Select female animal</option>
            <?php
    // Get the list of all male animal names
    $females = $animal->getAllCompatiblePartners('F', '', $breed);

    foreach ($females as $female) {
        echo '<option ';
        echo 'value="' . $female['id_animal'] . '">
         #' . $female['id_animal'] . ' ' . $female['animal_name'] . ' > ' . $female['breed_name'] . '</option>';
    }
    ?>
    </select>

</div>