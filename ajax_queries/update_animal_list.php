<?php

session_start();

include_once("../classes/animal.class.php");
include_once("../classes/dbconnect.class.php");

// Array with POST values names to save in SESSION
$post_values_to_save_in_session = [
    'sort',
    'name_filter',
    'breed_filter',
    'sex_filter',
    'current_page'
];


// Save the POST values mentionned in the $post_values_to_save_in_session to SESSION
foreach ($post_values_to_save_in_session as $value) {
    if (isset($_POST[$value])) {
        $_SESSION[$value] = $_POST[$value];
    }
}


// For debugging
var_dump($_POST);
echo '<br>';


// Get the values from SESSION
$sort = $_SESSION['sort'];
$name_filter = $_SESSION['name_filter'];
$breed_filter = $_SESSION['breed_filter'];
$sex_filter = $_SESSION['sex_filter'];
$current_page = intval($_SESSION['current_page']);
$rows_per_page = $_SESSION['rows_per_page'];

// Create instance of Animal object
$animal = new Animal();

// Send query to count the animals and store the value in SESSION
$animal_count = $animal->countAllFilteredAndSortedAnimals($sort, $name_filter, $breed_filter, $sex_filter);
$_SESSION['animal_count'] = $animal_count;


// Number of pages to display all animals
$total_page = ceil($animal_count / $rows_per_page);

// For debugging
echo 'current page : ';
var_dump($current_page);
echo '<br>';

// Calculate offset to inject in query
$offset = ($current_page - 1) * $rows_per_page;


// For debugging
echo 'offset : ';
var_dump($offset);
echo '<br>';

// Send query to get the animals
$filtered_animal_data = $animal->getAllFilteredAndSortedAnimals($sort, $name_filter, $breed_filter, $sex_filter, $rows_per_page, $offset);

$filtered_breed_list = $animal->getAllFilteredAndSortedBreeds($name_filter, $breed_filter, $sex_filter);
?>

<!-- Dropdown for breed filter -->
<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Breed
    </button>
    <ul class="dropdown-menu">
        <?php

        foreach ($filtered_breed_list as $one_breed) {
            echo "<li><a class='dropdown-item' href='#' 
                onclick='filterAnimalListByBreed(\"" . $one_breed['breed_name'] . "\")'>" . $one_breed['breed_name'] . " (" . $one_breed['breed_count'] . ")</a></li>";
        }
        ?>
    </ul>
</div>

<div class="reset-everything">
    <button class="btn"></button>


    <table>
        <!-- Header row -->
        <tr id="animal_list_header">
            <th></th>
            <?php
            $animal_columns = $animal->getColumnNames();
            // Display each column name
            foreach ($animal_columns as $column) {
                echo "<th>" . $column['label'];
                // For debugging
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
        foreach ($filtered_animal_data as $one_animal) {
            echo "<tr>
            <td>
            <a href='index.php?page=declare_death&id=" . $one_animal['id_animal'] . "'>💀</a>
            <a href='index.php?page=edit_animal&choice=edit&id=" . $one_animal['id_animal'] . "'>✏️</a>
            </td>";
            // In each column of one row, display the value of one of the animal characteristics
            foreach ($one_animal as $value) {
                echo "<td>" . $value . "</td>";
            }
            echo "</tr>";
        }
        ?>

    </table>


    <?php
    // Include navigation component
    include('../components/pagination.php');
    ?>