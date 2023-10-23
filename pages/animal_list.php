<h3><?php echo ucfirst($_SESSION['animal_specie']) ?> list</h3>

<?php
if (isset($_SESSION['open']) && $_SESSION['open'] > 0) {
    $animal = new Animal();
    $count_animals = $animal->countAnimals();
    echo "Total number of ".$_SESSION['animal_specie_plural']." : ".$count_animals[0][0]."<br><br>";
?>
<input class="button" type="button" onclick="window.location.href='index.php?page=edit_animal&id=new_entry'" value="Add new <?php echo $_SESSION['animal_specie'] ?>">
<table>
    <tr>
        <?php

        $animal_columns = $animal->getColumnNames();
        var_dump($animal_columns);
        echo "<br><br><br>";
        foreach ($animal_columns as $column) {
            echo "<th>".$column['label']."</th>";
        }

        ?>
    </tr>
    <?php

    $animal_list = $animal->getFullInfo();  


    // foreach ($user_list as $user) {
    //     echo "<td><a href='index.php?page=delete_animal&id=".$user['id_users']."'>❌</a> <a href='index.php?page=edit_animal&id=".$user['id_users']."'>✏️</a></td>";
    //     echo "<td>".$user['id_animal']."</td>";
    //     echo "<td>".$user['usr_login']."</td>";
    //     echo "<td>".$user['lastname']."</td>";
    //     echo "<td>".$user['firstname']."</td>";
    //     echo "</tr>";
    // }
} else {
    header("Location: index.php?page=admin");
}
?>
</table>