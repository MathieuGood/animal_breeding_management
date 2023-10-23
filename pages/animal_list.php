<h3>List of <?php echo $_POST['animal_specie'] ?></h3>

<?php
if (isset($_SESSION['open']) && $_SESSION['open'] > 0) {
    $users_db = new Snake();
    $count_snakes = $users_db->countSnakes();
    echo "Total number of ".$animal_specie_plural." : ".$count_users[0][0]."<br><br>";
?>
<input class="button" type="button" onclick="window.location.href='index.php?page=edit_animal&id=new_entry'" value="Add new <?php echo $_POST['animal_specie'] ?>">
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
        echo "<td><a href='index.php?page=delete_animal&id=".$user['id_users']."'>❌</a> <a href='index.php?page=edit_animal&id=".$user['id_users']."'>✏️</a></td>";
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