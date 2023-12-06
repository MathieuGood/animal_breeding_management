<h3>User login</h3>
<?php

// Instantiate a new User object to connect to database
$user_db = new User();


// On vérifie d'abord avef isset() si le formulaire a été envoyé
if (isset($_POST["form_submit"])) {
    $id = $_POST["user_name"];
    $pwd = $_POST["password"];
    // Si l'identifiant et le mot de passe correspondent, renseigner la variable SESSION
    if ($user_db->checkIfPwdIsCorrect($id, $pwd)) {
        $_SESSION['open'] = 1;
        $_SESSION['user_name'] = $_POST["user_name"];
        // Rafraîchir la page pour recharger le menu avec les nouvelles entrées pour admin
        header("Location: index.php?page=animal_list");
    } else {
        echo "Username or password not valid.<br /><br />";
    }
}
// Si l'utilisateur se déconnecte, on remet id_login à 0 et on détruit la session
if (isset($_POST['logout'])) {
    $_SESSION['open'] = 0;
    unset($_SESSION['open']);
    unset($_SESSION['user_name']);
    session_destroy();
    // Rafraîchir la page pour recharger le menu et supprimer les liens pour l'accès administrateur
    echo "<meta http-equiv='refresh' content='0'>";
}

// Si l'id_login est vide ou inférieur à 1, on affiche le formulaire de connexion
if (!isset($_SESSION['open']) || $_SESSION['open'] < 1) {
?>
<form method="POST" action="">
    <table class="formtable">
        <tr>
            <td>User name</td>
            <td><input type="text" name="user_name" value=""></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password" value=""></td>
        </tr>
    </table>
        <input class="button" type="submit" name="form_submit" value="Submit">
</form>


<?php 
} else {
    header("Location: index.php?page=animal_list");
?>

<form method="POST" action="">
    <input class="button" type="submit" name="logout" value="Logout">
</form>
<?php } ?>
