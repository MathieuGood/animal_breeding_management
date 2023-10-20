<h3>Suppression d'un utilisateur</h3>
<p>
    Êtes-vous certain de vouloir supprimer l'utilisateur suivant ?
</p>
<?php
$id = $_GET['id'];

if (isset($_SESSION['open']) && $_SESSION['open'] > 0 && isset($id)) {
    ?>
    <form method="POST" action="">
        <input class="button redbutton" type="button" onclick="window.location.href = 'index.php?page=liste_users'" value="Annuler">
        <input class="button" type="submit" name="validation" value="Confirmer la suppression">
    </form>
    <?php
    if (isset($_POST['validation'])) {
        $users_db = new Users();
        $users_db->delete($id);
        header("Location: index.php?page=liste_users");
    }
} else {
    header("Location: index.php?page=liste_users");
}
?>
