<?php

// Get $choice from $_GET : either 'new' or 'edit'
$choice = $_GET['choice'];

// Check if user is connected and if a choice has been made (new or edit)
if (isset($_SESSION['open']) && $_SESSION['open'] > 0 && isset($choice)) {
 

    // For debugging :
    // echo '<pre>'; var_dump($breeds); echo '</pre>';

    // In case of creating a new animal
    if ($choice == 'new') {
        // Create Animal() with no ID
        $animal = new Animal();
        // Change the header of page to "Create"
        $title_display = "Create";
        // Create array with empty strings to initalize form with no values"
        $animal_values = array(
            'id_breed' => '',
            'animal_name' => '',
            'animal_sex' => '',
            'animal_heigth' => '',
            'animal_weight' => '',
            'animal_lifespan' => '',
            'birth_timestamp' => '',
            'death_timestamp' => '',
            'id_father' => '',
            'id_mother' => ''
        );
    } else {
    // In case of editing existing animal
        // Get id of animal to edit from $_GET
        $id = $_GET['id'];
        // Create new Animal() with corresponding id
        $animal = new Animal($id);
        // Change the header of page to "Edit"
        $title_display = "Edit";
        // Get all the values of the animal to edit
        $animal_values = $animal->getAnimalData();

        // For debugging :
        // echo '<pre>'; var_dump($animal_values); echo '</pre>';
    }
        
    // When form is submitted
    if (isset($_POST['form_submit'])) {
        echo '<pre>'; var_dump($_POST); echo '</pre>';
        
        // Old code for inspiration
        // foreach ($_POST as $key => $value) {
        //     if ($key != 'form_submit') {
        //         $users_db->set($key, trim($value));
        //     }
        // }

    }
} else {
    header("Location: index.php?page=login");
}
?>

<h3><?php echo $title_display." ".$_SESSION['animal_specie'] ?></h3>

    <form class="userform" method="POST" action="">
        <table class="formtable"><p>

            <tr>
                <td>Breed</td>
                <td>
                    <select name="breed">
                    <?php
                    // Get the list of all breeds for the select options input
                    $breeds = $animal->getAnimalBreeds();
                    foreach ($breeds as $breed) {
                        echo '<option ';
                        if ($breed['id_breed'] == $animal_values['id_breed']) {
                            echo ' selected="selected" ';
                        }
                        echo 'value="'.$breed['id_breed'].'">'.$breed['breed_name'].'</option>';
                    }
                    ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Name</td>
                <td>
                    <input type=text name="animal_name" value="<?php echo $animal_values['animal_name'] ?>">
                </td>
            </tr>

            <tr>
                <td>Sex</td>
                <td>
                    <select name="sex">
                        <?php
                        foreach (['M', 'F'] as $sex) {
                            echo '<option ';
                            if ($sex == $animal_values['animal_sex']) {
                                echo ' selected="selected" ';
                            }
                            echo 'value="'.$sex.'">'.$sex.'</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Heigth</td>
                <td>
                    <input type=text name="animal_heigth" value="<?php echo $animal_values['animal_heigth'] ?>">
                </td>
            </tr>

            <tr>
                <td>Weigth</td>
                <td>
                    <input type=text name="animal_weight" value="<?php echo $animal_values['animal_weight'] ?>">
                </td>
            </tr>

            <tr>
                <td>Lifespan</td>
                <td>
                    <input type=text name="animal_lifespan" value="<?php echo $animal_values['animal_lifespan'] ?>">
                </td>
            </tr>

            <tr>
                <td>Birth</td>
                <td>
                    <input type=datetime-local name="birth_timestamp" value="<?php echo $animal_values['birth_timestamp'] ?>">
                </td>
            </tr>

            <tr>
                <td>Death</td>
                <td>
                    <input type=datetime-local name="death_timestamp" value="<?php echo $animal_values['death_timestamp'] ?>">
                </td>
            </tr>

            <tr>
                <td>Father</td>
                <td>
                    <select name="id_father">
                    <?php
                    // Get the list of all male animal names
                    $males = $animal->getAllAnimalNames('M');
    
                    foreach ($males as $male) {
                        echo '<option ';
                        if ($male['id_animal'] == $animal_values['id_father']) {
                            echo ' selected="selected" ';
                        }
                        echo 'value="'.$male['id_animal'].'">#'.$male['id_animal'].' '.$male['animal_name'].'</option>';
                    }
                    ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Mother</td>
                <td>
                <select name="id_mother">
                    <?php
                    // Get the list of all male animal names
                    $females = $animal->getAllAnimalNames('F');
    
                    foreach ($females as $female) {
                        echo '<option ';
                        if ($female['id_animal'] == $animal_values['id_mother']) {
                            echo ' selected="selected" ';
                        }
                        echo 'value="'.$female['id_animal'].'">#'.$female['id_animal'].' '.$female['animal_name'].'</option>';
                    }
                    ?>
                    </select>
                </td>
            </tr>

        </table></p>
            <input class="button redbutton" type="button" onclick="window.location.href='index.php?page=animal_list'" value="Cancel">
            <input class="button" type="submit" name="form_submit" value="Submit">
    </form>