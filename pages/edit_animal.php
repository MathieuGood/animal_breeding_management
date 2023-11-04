<?php

// Get id of animal from $_GET
$id = $_GET['id'];

$choice = $_GET['choice'];


if (isset($_SESSION['open']) && $_SESSION['open'] > 0 && isset($choice)) {

    if ($choice == 'new') {
        $animal = new Animal();
    } else {
        $animal = new Animal($id);
    }
        
    
    if ($choice == "new") {
        $title_display = "Create";
    } else {
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

            $values = $animal->getAnimalData();

            // For debugging
            echo '<pre>'; var_dump($animal_columns); echo '</pre>';
            echo '<pre>'; var_dump($values); echo '</pre>';

            $count = 0;
            foreach ($values as $key => $value) {
                echo "<tr>";
                echo "<td>".$animal_columns[$count]['label']."</td>";
                echo '<td><input type="'.$animal_columns[$count]['html_input_type'].'" name="'.$key.'" value="'.$value.'"></td>';
                echo "</tr>";
                $count++;

            }
            ?>
        </table></p>
            <input class="button redbutton" type="button" onclick="window.location.href='index.php?page=animal_list'" value="Cancel">
            <input class="button" type="submit" name="form_submit" value="Submit">
    </form>