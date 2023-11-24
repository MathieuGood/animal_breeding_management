<h3>
    <?php echo ucfirst($_SESSION['animal_specie']) ?> list
</h3>

<?php
// If the user is logged in
if (isset($_SESSION['open']) && $_SESSION['open'] > 0) {

    $animal = new Animal();

    // Reset all filters and sorting
    $_SESSION['sort'] = 'id_animal ASC';
    $_SESSION['name_filter'] = '';
    $_SESSION['breed_filter'] = '';
    $_SESSION['sex_filter'] = '';

    // Display the total number of animals
    $count_animals = $animal->countAnimals();
    echo "Total number of " . $_SESSION['animal_specie_plural'] . " : " . $count_animals[0]['count_table'] . "<br><br>";



    if (isset($_POST['random_animal'])) {
        $animal->createRandomAnimal($_POST['amount_to_create']);
    }
    ?>
    <input class="button" type="button" onclick="window.location.href='index.php?page=edit_animal&choice=new'"
        value="Add new custom <?php echo $_SESSION['animal_specie'] ?>">


    <form method="POST" action="">
        <input type=number step="1" min="1" max="500000" name="amount_to_create" value="1">
        <input class="button" type="submit" name="random_animal"
            value="Create random <?php echo $_SESSION['animal_specie_plural'] ?> ">
    </form>

    <table id="animal_list">
        <?php
} else {
    header("Location: index.php?page=login");
}


?>

</table>

<script>
    // When the page loads, execute sortAnimalList() with 'animal_id DESC' as parameter
    window.onload = function () {
        sortAnimalList('id_animal DESC');
    }

    // When the user clicks on the button, sort the list
    // If the ajax query returns a success, update the table
    function sortAnimalList($sort) {
        $.ajax({
            type: "POST",
            url: "ajax_queries/sort_animal_list.php",
            data: {
                sort: $sort,
            },
            cache: false,
            success: function (data) {
                // For debugging
                // console.log(data);
                let animal_list_table = document.getElementById("animal_list");
                console.log(animal_list_table);
                animal_list_table.innerHTML = data;
                console.log(animal_list_table);
            }
        });
    }
</script>