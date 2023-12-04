<h3>
    <?php echo ucfirst($_SESSION['animal_specie']) ?> list
</h3>

<?php
// If the user is logged in
if (isset($_SESSION['open']) && $_SESSION['open'] > 0) {

    // On page load, reset all filters, sorting and pagination stored in $_SESSION
    include('ajax_queries/reset_search_parameters.php');

    // Instantiate new Animal object
    $animal = new Animal();

    // Display the total number of animals
    // REFRESHES ON PAGE RELOAD ONLY
    // FOR FUTURE : make it part of AJAX query when creating animals

    $sex_count = $animal->countAllAliveAnimalsBySex();

    $total_count = $sex_count[1]['count'] + $sex_count[0]['count'];

    echo "Total number of " . $_SESSION['animal_specie_plural'] . " : " . $total_count;
    echo "<br>";
    // echo "Male : " . $count_male;
    echo "Male : " . $sex_count[1]['count'];
    echo "<br>";
    // echo "Female : " . $count_female;
    echo "Female : " . $sex_count[0]['count'];
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
            resetSearchParameters();
        }


        // Set all the parameters stored in SESSION to default
        function resetSearchParameters() {
            $.post("ajax_queries/reset_search_parameters.php");
            sortAnimalList('id_animal DESC');
        }


        // AJAX function for sorting
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


        // AJAX function for filtering by breed
        function filterAnimalListByBreed(type) {
            $.ajax({
                type: "POST",
                url: "ajax_queries/update_animal_list.php",
                data: {
                    breed_filter: type,
                    current_page: '1',
                },
                // If the ajax query returns a success, update the table
                success: function (data) {
                    let animal_list_table = document.getElementById("animal_list");
                    animal_list_table.innerHTML = data;
                }
            });
        }


        // AJAX function for filtering by sex
        function filterAnimalListBySex(type) {
            $.ajax({
                type: "POST",
                url: "ajax_queries/update_animal_list.php",
                data: {
                    sex_filter: type,
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