<h3>Connexion administrateur</h3>
<?php

// Connexion à la base de données
$users_db = new User();


// On vérifie d'abord avef isset() si le formulaire a été envoyé
if (isset($_POST["validation"])) {
    $id = $_POST["login"];
    $pwd = $_POST["password"];
    // Si l'identifiant et le mot de passe correspondent, renseigner la variable SESSION
    if ($users_db->checkIfPwdIsCorrect($id, $pwd)) {
        $_SESSION['open'] = 1;
        $_SESSION['login_id'] = $_POST["login"];
        // Rafraîchir la page pour recharger le menu avec les nouvelles entrées pour admin
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "Erreur de connexion : couple nom d'utilisateur/mot de passe non valide<br /><br />";
    }
}
// Si l'utilisateur se déconnecte, on remet id_login à 0 et on détruit la session
if (isset($_POST['logout'])) {
    $_SESSION['open'] = 0;
    unset($_SESSION['open']);
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
            <td>Identifiant</td>
            <td><input type="text" name="login" value=""></td>
        </tr>
        <tr>
            <td>Mot de passe</td>
            <td><input type="password" name="password" value=""></td>
        </tr>
    </table>
        <input class="button" type="submit" name="validation" value="Valider">
</form>


<?php 
} else {
    // echo "<meta http-equiv='refresh' content='0'>";
    $full_name = $users_db->getFullName($_SESSION['login_id']);
    echo "Bonjour ".$full_name.", bienvenue dans votre espace administrateur.<br /><br />";
?>

<form method="POST" action="">
    <input class="button" type="submit" name="logout" value="Déconnexion">
</form>
<?php } ?>
