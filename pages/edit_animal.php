<?php

// Get id of animal from $_GET
$id = $_GET['id'];

$choice = $_GET['choice'];


if (isset($_SESSION['open']) && $_SESSION['open'] > 0 && isset($choice)) {

    if ($choice == 'new') {
        $animal = new Animal();
        $title_display = "Create";
    } else {
        $animal = new Animal($id);
        $title_display = "Edit";
    }
        

    if (isset($_POST['form_submit'])) {

        if ($users_db->checkIfUsrLoginExists($id, trim($_POST['usr_login'])) == 0) {

            foreach ($_POST as $key => $value) {
                if ($key != 'form_submit') {
                    $users_db->set($key, trim($value));
                }
            }
            header("Location: index.php?page=animal_list");
            // Alternative JS pour changer de page
            // echo "<script>window.location='index.php?page=admin'</script>";

        } else {
            echo "User name already exists.";
        }    
    }
} else {
    header("Location: index.php?page=login");
}
// Transformer les champs en text_area si besoin d'avoir des caractères spéciaux, surtout des ""
?>
<h3><?php echo $title_display." ".$_SESSION['animal_specie'] ?></h3>

    <form class="userform" method="POST" action="">
        <table class="formtable"><p>
            <?php
            $animal_columns = $animal->getColumnNamesAndInputType();

            $animal_values = $animal->getAnimalData();
            echo $animal_values['animal_name'];


            $breeds = $animal->getAnimalBreeds();
            echo '<pre>'; var_dump($animal_values); echo '</pre>';
            ?>

            <tr>
                <td>Breed</td>
                <td>
                    <select name="breed">
                    <?php
                    $breeds = $animal->getAnimalBreeds();
                    foreach ($breeds as $breed) {
                        echo '<option value="'.$breed['id_breed'].'">'.$breed['breed_name'].'</option>';
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
                        <option value="M">Male</option>
                        <option value="F">Female</option>
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
                    <input type=text name="id_father" value="<?php echo $animal_values['id_father'] ?>">
                </td>
            </tr>

            <tr>
                <td>Mother</td>
                <td>
                    <input type=text name="id_mother" value="<?php echo $animal_values['id_mother'] ?>">
                </td>
            </tr>

        </table></p>
            <input class="button redbutton" type="button" onclick="window.location.href='index.php?page=animal_list'" value="Cancel">
            <input class="button" type="submit" name="form_submit" value="Submit">
    </form>