<?php
$id = $_GET['id'];
if (isset($_SESSION['open']) && $_SESSION['open'] > 0 && isset($id)) {
    $animal = new Animal($id);
    ?>
    <p>
    Would you like to declare the death of <?php echo $_SESSION['animal_specie']." ".$animal->getAnimalName() ?> ?
    </p>
    <form method="POST" action="">
        <p>
            Enter date of death  <input class="" type="datetime-local" name="death_date">
        </p>
        <input class="button redbutton" type="button" onclick="window.location.href = 'index.php?page=animal_list'" value="Cancel">
        <input class="button" type="submit" name="form_submit" value="Confirm death">
    </form>
    <?php
    if (isset($_POST['form_submit'])) {
        $animal->declareDead(date("Y-m-d H:i:s", strtotime($_POST["death_date"])));
        header("Location: index.php?page=animal_list");
    }
} else {
    header("Location: index.php?page=animal_list");
}
?>