<?php

session_start();

include_once("../classes/animal.class.php");
include_once("../classes/dbconnect.class.php");

// Array to store the POST values names to save in SESSION
$post_values_to_save_in_session = [
    'sort',
    'name_filter',
    'breed_filter',
    'sex_filter',
    'page'
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
$current_page = $_SESSION['current_page'];
$rows_per_page = $_SESSION['rows_per_page'];

// Create instance of Animal object
$animal = new Animal();

// Send query to count the animals and store the value in SESSION
$animal_count = $animal->countAllFilteredAndSortedAnimals($sort, $name_filter, $breed_filter, $sex_filter);
$_SESSION['animal_count'] = $animal_count;

// Values for pagination
$total_page = ceil($animal_count / $rows_per_page);

if ($current_page <= 1) {
    $current_page = 1;
    $first_page = "";
    $prev_page = "";
} else {
    $first_page = 1;
    $prev_page = $current_page - 1;
}

if ($current_page >= $total_page) {
    $current_page = $total_page;
    $last_page = "";
    $next_page = "";
} else {
    $last_page = $total_page;
    $next_page = $current_page + 1;
}




$offset = ($current_page - 1) * $rows_per_page;

// Send query to get the animals
$result = $animal->getAllFilteredAndSortedAnimals($sort, $name_filter, $breed_filter, $sex_filter, $rows_per_page, $offset);



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
        <div id="display_stats">
            <?php echo "Showing records ".($offset + 1)." to ".($offset + $rows_per_page)." out of ".$animal_count." total" ?>
        </div>
        <div id="page_selection">
            <span>
                <?php echo $animal_count . " pages /" ?>
            </span>

            <span id="first_page">
                <?php echo $first_page ?>
                <?php echo " ... " ?>
            </span>

            <span id="prev_page">
                <?php echo $prev_page ?>
            </span>
            <?php echo " | " ?>

            <span id="curr_page">
                <?php echo $current_page ?>
            </span>
            <?php echo " | " ?>

            <span id="next_page">
                <?php echo $next_page ?>
            </span>

            <span id="last_page">
                <?php echo " ... " ?>
                <?php echo $last_page ?>
            </span>
        </div>

    </td>
</tr>