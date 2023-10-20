<h3>Declare <?php echo $_POST['animal_specie'] ?> as deceased</h3>
<p>
    Would you like to declare deceased the following <?php echo $_POST['animal_specie'] ?> ?
</p>
<?php
$id = $_GET['id'];

if (isset($_SESSION['open']) && $_SESSION['open'] > 0 && isset($id)) {
    ?>
    <form method="POST" action="">
        <input class="button redbutton" type="button" onclick="window.location.href = 'index.php?page=animal_list'" value="Cancel">
        <input class="button" type="submit" name="form_submit" value="Confirm death">
    </form>
    <?php
    if (isset($_POST['form_submit'])) {
        $users_db = new Users();
        $users_db->delete($id);
        header("Location: index.php?page=animal_list");
    }
} else {
    header("Location: index.php?page=animal_list");
}
?>
