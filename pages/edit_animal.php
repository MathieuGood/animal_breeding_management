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
        
        // Creating two arrays to contatins column names and values for SQL insert query
        $columns = array();
        $values = array();
        
        // Iterating over $_POST form values with keys as input field names
        foreach ($_POST as $key => $value) {
            if ($key != 'form_submit') {
                // If the the field in the array has datetime-local value
                if (in_array($key, ['birth_timestamp', 'death_timestamp'])) {
                    // If it is empty, update value to datetime compatible output
                    if ($value == "") {
                        $value = "0000-00-00 00:00:00";
                    } else {
                    // Trim the "T" from the datetime-local input value
                        $value = str_replace('T', " ", $value);
                    }
                }

                // Trim value from spaces
                $value = trim($value);
                
                // Add column names and values $columns and $values for createAnimal()
                array_push($columns, $key);
                array_push($values, $value);

                // Editing existing animal
                if ($choice == 'edit') {
                    $animal->update($key, $value);
                }
            }
        }

        // Creating new animal
        if ($choice == 'new') {
            $animal->createAnimal($columns, $values);
        }
    // Retrieve the update values of the edited/created animal
    $animal_values = $animal->getAnimalData();
    }
} else {
    header("Location: index.php?page=login");
}
?>

<h3 class="drac-heading drac-heading-xl drac-text-green drac-p-xs"><?php echo $title_display." ".$_SESSION['animal_specie'] ?></h3>

    <form class="userform" method="POST" action="">
        <table class="formtable drac-table drac-table-green"><p>

            <tr>
                <td class="drac-text drac-text-white">Breed</td>
                <td class="drac-text drac-text-white">
                    <select name="id_breed">
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
                <td class="drac-text drac-text-white">Name</td>
                <td class="drac-text drac-text-white">
                    <input class="drac-input drac-input-border-sm drac-input-green drac-text-green drac-m-xs"  type=text name="animal_name" value="<?php echo $animal_values['animal_name'] ?>">
                </td>
            </tr>

            <tr>
                <td class="drac-text drac-text-white">Sex</td>
                <td class="drac-text drac-text-white">
                        <?php
                        foreach (['M', 'F'] as $sex) {
                            echo '<input class="drac-input drac-input-border-sm drac-input-green drac-text-green drac-m-xs"  type="radio" id="'.$sex.'" name="animal_sex" value="'.$sex.'"';
                            if ($sex == $animal_values['animal_sex']) {
                                echo ' checked';
                            }
                            echo '>&nbsp;<label for="'.$sex.'">'.$sex.'</label>';
                        }
                        ?>
                </td>
            </tr>

            <tr>
                <td class="drac-text drac-text-white">Heigth</td>
                <td class="drac-text drac-text-white">
                    <input class="drac-input drac-input-border-sm drac-input-green drac-text-green drac-m-xs"  type=number step="1" min="1" max="1400" name="animal_heigth" value="<?php echo $animal_values['animal_heigth'] ?>">
                </td>
            </tr>

            <tr>
                <td class="drac-text drac-text-white">Weigth</td>
                <td class="drac-text drac-text-white">
                    <input class="drac-input drac-input-border-sm drac-input-green drac-text-green drac-m-xs"  type=number step="1" min="1" max="200000" name="animal_weight" value="<?php echo $animal_values['animal_weight'] ?>">
                </td>
            </tr>

            <tr>
                <td class="drac-text drac-text-white">Lifespan</td>
                <td class="drac-text drac-text-white">
                    <input class="drac-input drac-input-border-sm drac-input-green drac-text-green drac-m-xs"  class="drac-input drac-input-border-sm drac-input-green drac-text-green drac-m-xs"  type=number step="1" min="1" max="300" name="animal_lifespan" value="<?php echo $animal_values['animal_lifespan'] ?>">
                </td>
            </tr>

            <tr>
                <td class="drac-text drac-text-white">Birth</td>
                <td class="drac-text drac-text-white">
                    <input class="drac-input drac-input-border-sm drac-input-green drac-text-green drac-m-xs"  type=datetime-local name="birth_timestamp" value="<?php echo $animal_values['birth_timestamp'] ?>">
                </td>
            </tr>

            <tr>
                <td class="drac-text drac-text-white">Death</td>
                <td class="drac-text drac-text-white">
                    <input class="drac-input drac-input-border-sm drac-input-green drac-text-green drac-m-xs"  type=datetime-local name="death_timestamp" value="<?php echo $animal_values['death_timestamp'] ?>">
                </td>
            </tr>

            <tr>
                <td class="drac-text drac-text-white">Father</td>
                <td class="drac-text drac-text-white">
                <div style="display: flex; flex-direction: column">
                    <div style="margin-bottom: 10px">
                        <div style="position: relative">
                            <select class="drac-select drac-select-lg drac-select-pink"  name="id_father">
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
                            <div class="drac-select-arrow drac-text-white">
                                <svg
                                viewBox="0 0 24 24"
                                focusable="false"
                                role="presentation"
                                aria-hidden="true"
                                >
                                    <path
                                    fill="currentColor"
                                    d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"
                                    ></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                            </td>

            </tr>

            <tr>
                <td class="drac-text drac-text-white">Mother</td>
                <td class="drac-text drac-text-white">
                <div style="display: flex; flex-direction: column">
                    <div style="margin-bottom: 10px">
                        <div style="position: relative">
                            <select class="drac-select drac-select-lg drac-select-pink" name="id_mother">
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
                            <div class="drac-select-arrow drac-text-white">
                                <svg
                                viewBox="0 0 24 24"
                                focusable="false"
                                role="presentation"
                                aria-hidden="true"
                                >
                                    <path
                                    fill="currentColor"
                                    d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"
                                    ></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

        </table></p>
            <input class="button redbutton" type="button" onclick="window.location.href='index.php?page=animal_list'" value="Cancel">
            <input class="button" type="submit" name="form_submit" value="Submit">
    </form>