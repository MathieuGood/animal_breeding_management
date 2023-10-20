<h3>Liste des utilisateurs</h3>

<?php
if (isset($_SESSION['open']) && $_SESSION['open'] > 0) {
    $users_db = new Users();
    $count_users = $users_db->countUsers();
    echo "Nombre d'utilisateurs enregistrés : ".$count_users[0][0].'<br><br>';
?>
<input class="button" type="button" onclick="window.location.href='index.php?page=edit_user&id=new_entry'" value="Generate population evolution">

<?php
} else {
    header("Location: index.php?page=admin");
}
?>