<?php
$id = $_GET['id'];

if (isset($_SESSION['open']) && $_SESSION['open'] > 0 && isset($id)) {

    $users_db = new Users($id);
    
    if ($id == "new_entry") {
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
<h3><?php echo $title_display ?> d'un utilisateur</h3>
    <form class="userform" method="POST" action="">
        <table class="formtable"><p>
            <tr>

                <td>Nom d'utilisateur</td>
                <td><input type="text" name="usr_login" value="<?php echo $users_db->get('usr_login') ?>"></td>
            </tr>
            <tr>
                <td>Nom</td>
                <td><input type="text" name="lastname" value="<?php echo $users_db->get('lastname') ?>"></td>
            </tr>
            <tr>
                <td>Prénom</td>
                <td><input type="text" name="firstname" value="<?php echo $users_db->get('firstname') ?>"></td>
            </tr>
            <tr>
                <td>Mot de passe</td>
                <td><input type="text" name="pwd" value="<?php echo $users_db->get('pwd') ?>"></td>
            </tr>
        </table></p>
            <input class="button redbutton" type="button" onclick="window.location.href='index.php?page=animal_list'" value="Cancel">
            <input class="button" type="submit" name="form_submit" value="Submit">
    </form>