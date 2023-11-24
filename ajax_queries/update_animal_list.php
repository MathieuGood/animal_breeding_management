<?php

session_start();

include_once("../classes/animal.class.php");
include_once("../classes/dbconnect.class.php");

// Array to store the POST values names to save in SESSION
$post_values_to_save_in_session = [
    'sort',
    'name_filter',
    'breed_filter',
    'sex_filter'
];


// Save the POST values in SESSION
foreach ($post_values_to_save_in_session as $value) {
    if (isset($_POST[$value])) {
        $_SESSION[$value] = $_POST[$value];
    }
}

// Get the values from SESSION
$sort = $_SESSION['sort'];
$name_filter = $_SESSION['name_filter'];
$breed_filter = $_SESSION['breed_filter'];
$sex_filter = $_SESSION['sex_filter'];
$limit_start = $_SESSION['page'] * 10 - 10;
$limit_end = $_SESSION['page'] * 10;
$current_page = $_SESSION['current_page'];

// Send query to get the animals
$animal = new Animal();
$result = $animal->getAllFilteredAndSortedAnimals($sort, $name_filter, $breed_filter, $sex_filter, $limit_start, $limit_end);

// Send query to count the animals and store the value in SESSION
$animal_count = $animal->countAllFilteredAndSortedAnimals($sort, $name_filter, $breed_filter, $sex_filter);
$_SESSION['animal_count'] = $animal_count

// For debugging
// var_dump($result);


    // Build header row
    ?>
<tr id="animal_list_header">
    <th></th>
    <?php
    $animal_columns = $animal->getColumnNames();
    foreach ($animal_columns as $column) {
        echo "<th>" . $column['label'];
        // var_dump($column);
        ?>
        <div id="sort_arrows">
            <button name=" <?php echo $column['id_column_label']; ?>_asc"
                value="<?php echo $column['id_column_label']; ?> ASC"
                onclick="sortAnimalList('<?php echo $column['id_column_label']; ?> ASC')">&uarr;</button>
            <button name="<?php echo $column['id_column_label']; ?>_desc"
                value="<?php echo $column['id_column_label']; ?> DESC"
                onclick="sortAnimalList('<?php echo $column['id_column_label']; ?> DESC')">&darr;</button>
        </div>
        </th>
        <?php
    }
    ?>
</tr>

<?php
// Build row for each animal
foreach ($result as $one_animal) {
    echo "<tr>
            <td>
            <a href='index.php?page=declare_death&id=" . $one_animal['id_animal'] . "'>💀</a>
            <a href='index.php?page=edit_animal&choice=edit&id=" . $one_animal['id_animal'] . "'>✏️</a>
            </td>";
    foreach ($one_animal as $value) {
        echo "<td>" . $value . "</td>";
    }
    echo "</tr>";
}
?>

<tr>
    <td id="pagination" colspan="100%" style="text-align:center">
        <span><?php echo $animal_count." pages /"?></span>
        <span id="first_page">FIRST</span>
        <span id="prev_page">PREV</span>
        <span id="curr_page"><?php echo $current_page ?></span>
        <span id="next_page">NEXT</span>
        <span id="last_page">LAST</span>
    </td>
</tr>