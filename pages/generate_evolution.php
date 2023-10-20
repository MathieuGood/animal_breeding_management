<h3>Liste des utilisateurs</h3>

<?php
if (isset($_SESSION['open']) && $_SESSION['open'] > 0) {
    $users_db = new Users();
    $count_users = $users_db->countUsers();
    echo "Nombre d'utilisateurs enregistrés : ".$count_users[0][0].'<br><br>';
?>
<input class="button" type="button" onclick="window.location.href='index.php?page=edit_user&id=new_entry'" value="Créer un nouvel utilisateur">
<table>
    <tr>
        <th></th>
        <th>ID</th>
        <th>Login</th>
        <th>Nom</th>
        <th>Prénom</th>
    </tr>
    <tr>
    <?php

    $user_list = $users_db->getFullInfo();  

    foreach ($user_list as $user) {
        echo "<td><a href='index.php?page=delete_user&id=".$user['id_users']."'>❌</a> <a href='index.php?page=edit_user&id=".$user['id_users']."'>✏️</a></td>";
        echo "<td>".$user['id_users']."</td>";
        echo "<td>".$user['usr_login']."</td>";
        echo "<td>".$user['lastname']."</td>";
        echo "<td>".$user['firstname']."</td>";
        echo "</tr>";
    }
} else {
    header("Location: index.php?page=admin");
}
?>
</table>