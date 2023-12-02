<h3>
    <?php echo ucfirst($_SESSION['animal_specie']) ?> list
</h3>

<?php
// If the user is logged in
if (isset($_SESSION['open']) && $_SESSION['open'] > 0) {

    $animal = new Animal();

    // On page load, reset all filters, sorting and pagination stored in $_SESSION
    $_SESSION['sort'] = 'id_animal ASC';
    $_SESSION['name_filter'] = '';
    $_SESSION['breed_filter'] = '';
    $_SESSION['sex_filter'] = '';
    $_SESSION['current_page'] = 1;
    $_SESSION['rows_per_page'] = 5;

    // Display the total number of animals
    // REFRESHES ON PAGE RELOAD ONLY
    // FOR FUTURE : make it part of AJAX query when creating animals
    $count_male = $animal->countAllAliveAnimalsBySex('M');
    $count_female = $animal->countAllAliveAnimalsBySex('F');
    $count_animals = $count_male + $count_female;
    echo "Total number of " . $_SESSION['animal_specie_plural'] . " : " . $count_animals;
    echo "<br>";
    echo "Male : " . $count_male;
    echo "<br>";
    echo "Female : " . $count_female;
    echo "<br>";


    if (isset($_POST['random_animal'])) {
        $animal->createRandomAnimal($_POST['amount_to_create']);
    }
    ?>
    <input class="button" type="button" onclick="window.location.href='index.php?page=edit_animal&choice=new'"
        value="Add new custom <?php echo $_SESSION['animal_specie'] ?>">


    <form method="POST" action="">
        <input type=number step="1" min="1" max="50000" name="amount_to_create" value="1">
        <input class="button" type="submit" name="random_animal"
            value="Create random <?php echo $_SESSION['animal_specie_plural'] ?> ">
    </form>

    <div id="animal_list">

    </div>


    <script>
        // When the page loads, execute sortAnimalList() with 'animal_id DESC' as default parameter 
        window.onload = function () {
            sortAnimalList('id_animal DESC');
        }





        
        // When the user clicks on the button, sort according to the type parameter and reset current_page to 1
        function sortAnimalList(type) {
            $.ajax({
                type: "POST",
                url: "ajax_queries/update_animal_list.php",
                data: {
                    sort: type,
                    current_page: '1',
                },
                // If the ajax query returns a success, update the table
                success: function (data) {
                    let animal_list_table = document.getElementById("animal_list");
                    animal_list_table.innerHTML = data;
                }
            });
        }


        // When the user clicks on the button, navigate to input current_page number
        function pageAnimalList(page_number) {
            $.ajax({
                type: "POST",
                url: "ajax_queries/update_animal_list.php",
                data: {
                    current_page: page_number,
                },
                // If the ajax query returns a success, update the table
                success: function (data) {
                    let animal_list_table = document.getElementById("animal_list");
                    animal_list_table.innerHTML = data;
                }
            });
        }
    </script>
    <?php
} else {
    header("Location: index.php?page=login");
}
?>