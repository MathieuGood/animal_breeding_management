<h3>Generate population evolution</h3>

<?php
if (isset($_SESSION['open']) && $_SESSION['open'] > 0) {
    $animal = new Animal();
    ?>

    <select name='male_animal' value="---">
        <option>Select male animal</option>
        <?php
        // Get the list of all male animal names
        $males = $animal->getAllAliveAnimalsBySex('M');

        foreach ($males as $male) {
            echo '<option ';
            echo 'value="' . $male['id_animal'] . '">#' . $male['id_animal'] . ' ' . $male['animal_name'] . '</option>';
        }
        ?>

    </select>

    <select name='female_animal' value="---">
        <option value='0'>Select female animal</option>
        <?php
        // Get the list of all male animal names
        $females = $animal->getAllAliveAnimalsAndParentsBySex('F');

        foreach ($females as $female) {
            echo '<option ';
            echo 'value="' . $female['id_animal'] . '">#' . $female['id_animal'] . ' ' . $female['animal_name'] . '</option>';
        }
        ?>

    </select>

    <input class="button" type="submit" name="start_mating" value="Animal mating">

    <?php

} else {
    header("Location: index.php?page=admin");
}
?>