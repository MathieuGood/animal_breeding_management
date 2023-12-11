<?php

include_once("../classes/animal.class.php");
include_once("../classes/dbconnect.class.php");

$animal = new Animal();

$breed = $_POST['breed'];

?>

<div class="col-auto">

<select name='male_animal' id='select_male' value="---" <?php if ($breed == '') echo 'disabled' ?> >
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


<div class="col-auto">

<select name='female_animal' id='select_female' value="---" <?php if ($breed == '') echo 'disabled' ?> >
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