<h3 class="drac-heading drac-heading-xl drac-text-green  drac-p-xs"><?php echo ucfirst($_SESSION['animal_specie']) ?> list</h3>

<?php
if (isset($_SESSION['open']) && $_SESSION['open'] > 0) {
    $animal = new Animal();
    $count_animals = $animal->countAnimals();
    echo "Total number of ".$_SESSION['animal_specie_plural']." : ".$count_animals[0]['count_table']."<br><br>";
    echo time()."<br>";
?>
<input class="button" type="button" onclick="window.location.href='index.php?page=edit_animal&choice=new'" value="Add new <?php echo $_SESSION['animal_specie'] ?>">
<table class="drac-table drac-table-green">
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

    $animal_list = $animal->getAllAnimals();
    foreach ($animal_list as $animal) {
        echo "<td class='drac-text drac-text-white'><a href='index.php?page=declare_death&id=".$animal['id_animal']."'>💀</a> <a href='index.php?page=edit_animal&choice=edit&id=".$animal['id_animal']."'>✏️</a></td>";
        foreach ($animal as $value) {
            echo "<td class='drac-text drac-text-white'>".$value."</td>";
        }
        echo "</tr>";
    }
} else {
    header("Location: index.php?page=login");
}
?>
</table>