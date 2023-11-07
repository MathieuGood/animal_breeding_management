<h3><?php echo ucfirst($_SESSION['animal_specie']) ?> list</h3>

<?php
if (isset($_SESSION['open']) && $_SESSION['open'] > 0) {
    $animal = new Animal();
    $count_animals = $animal->countAnimals();
    echo "Total number of ".$_SESSION['animal_specie_plural']." : ".$count_animals[0]['count_table']."<br><br>";

    if (isset($_POST['random_animal'])) {
        var_dump($_POST['amount_to_create']);
        $animal->createRandomAnimal($_POST['amount_to_create']);
    }
?>
<input class="button" type="button" onclick="window.location.href='index.php?page=edit_animal&choice=new'" value="Add new custom <?php echo $_SESSION['animal_specie'] ?>">


<form method="POST" action="">
    <input type=number step="1" min="1" max="500000" name="amount_to_create" value="1">
    <input class="button" type="submit" name="random_animal"value="Create random <?php echo $_SESSION['animal_specie_plural'] ?>">
</form>

<table>
    <tr>
        <th></th>
        <?php
        $animal_columns = $animal->getColumnNames('animal');
        foreach ($animal_columns as $column) {
            echo "<th>".$column['label']."</th>";
        }
        ?>
    </tr>
    <?php

    $animal_list = $animal->getAllLiveAnimals();
    foreach ($animal_list as $one_animal) {
        echo "<td><a href='index.php?page=declare_death&id=".$one_animal['id_animal']."'>💀</a> <a href='index.php?page=edit_animal&choice=edit&id=".$one_animal['id_animal']."'>✏️</a></td>";
        foreach ($one_animal as $value) {
            echo "<td>".$value."</td>";
        }
        echo "</tr>";
    }
} else {
    header("Location: index.php?page=login");
}


?>
</table>
