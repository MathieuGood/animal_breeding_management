<h3>
    <?php echo ucfirst($_SESSION['animal_specie']) ?> list
</h3>

<?php
// If the user is logged in
if(isset($_SESSION['open']) && $_SESSION['open'] > 0) {

    // On page load, reset all filters, sorting and pagination stored in $_SESSION
    include('ajax_queries/reset_search_parameters.php');

    // Instantiate new Animal object
    $animal = new Animal();


    if(isset($_POST['random_animal'])) {
        $animal->createRandomAnimal($_POST['amount_to_create']);
    }
    ?>
    <div class="container row">

        <div class="create_animal col-sm-auto">
            <input class="button" style="width:100%; margin:0.3em 0 0.5em 0;" type="button"
                onclick="window.location.href='index.php?page=edit_animal&choice=new'"
                value="Add new custom <?php echo $_SESSION['animal_specie'] ?>">

            <span class="create_multiple_animals">
                <form id="create_multiple_animals" method="POST" action="">
                    <input type=number step="1" min="1" max="1000" name="amount_to_create" value="1">
                    <input class="button" style="width:auto; margin:0" type="submit" name="random_animal"
                        value="Create random <?php echo $_SESSION['animal_specie_plural'] ?> ">
                </form>
            </span>

        </div>

        <div class="snake_count col-sm-auto">
            <?php
            // Display the total number of animals
            $sex_count = $animal->countAllAliveAnimalsBySex();

            $total_count = $sex_count[1]['count'] + $sex_count[0]['count'];

            ?>
            <h6>
                <?php echo ucfirst($_SESSION['animal_specie'])." total count : ".$total_count; ?>
                <span class="badge bg-secondary">New</span>
            </h6>

            <h6>
                Male :
                <?php echo $sex_count[1]['count'] ?>
            </h6>

            <h6>
                Female :
                <?php echo $sex_count[0]['count'] ?>
            </h6>

        </div>


    </div>



    <div id="animal_list">

    </div>


    <script>
        // When the page loads, execute sortAnimalList() with 'animal_id DESC' as default parameter 
        window.onload = function () {
            resetSearchParameters();
        }


        // Set all the parameters stored in SESSION to default
        function resetSearchParameters() {
            $.ajax({
                type: "POST",
                url: "ajax_queries/update_animal_list.php",
                data: {
                    sort: 'id_animal DESC',
                    breed_filter: '',
                    sex_filter: '',
                    name_filter: '',
                    current_page: '1',
                },
                // If the ajax query returns a success, update the table
                success: function (data) {
                    let animal_list_table = document.getElementById("animal_list");
                    animal_list_table.innerHTML = data;
                }
            });
        }


        function createRandomAnimalsAndUpdateList(number) {
            $.ajax({
                type: "POST",
                url: "ajax_queries/create_random_animal.php",
                data: {
                    amount_to_create: number,
                },
                // If the ajax query returns a success, update the table
                success: resetSearchParameters()
            });
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
                    trigger_listener = true
                }
            });
        }


        // AJAX function for filtering by name
        function filterAnimalListByName(type) {
            $.ajax({
                type: "POST",
                url: "ajax_queries/update_animal_list.php",
                data: {
                    name_filter: type,
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



        // Add event listener to watch for click on form id="create_multiple_animals"
        // and execute createRandomAnimalsAndUpdateList() with the input value as parameter
        document.getElementById("button").addEventListener("click", createRandomAnimalsAndUpdateList())
        console.log(document.getElementById("button"))


        // Not working for now
        document.addEventListener("DOMContentLoaded", function () {
            var name_filter_input = document.getElementById("name_filter")
            console.log(name_filter_input)
            name_filter_input.addEventListener("change", () => filterAnimalListByBreed(name_filter_input.textContent))
        })






    </script>
    <?php
} else {
    // If the user is not logged in, redirect to login page
    header("Location: index.php?page=login");
}
?>