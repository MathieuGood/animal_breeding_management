<?php
if (isset($_SESSION['open']) && $_SESSION['open'] > 0) {
    $animal = new Animal();
    ?>

    <div class="container d-flex flex-column" id="main-content">

        <!-- <span class="d-flex justify-content-center text-align-center"> -->
            <h3 class="justify-content-center">Breed animals together</h3>
        <!-- </span> -->

        <div class="row d-flex justify-content-center">

            <div class="col-auto">

                <select name="select_breed" id="select_breed" value="---">

                    <option>Select breed</option>
                    <?php
                    // Get the list of breeds base on the animals in the animal table
                    $breeds = $animal->getCurrentBreeds();
                    foreach ($breeds as $breed) {
                        echo '<option value="' . $breed['id_breed'] . '">'
                            . $breed['breed_name'] .
                            '</option>';
                    }
                    ;
                    ?>
                </select>

            </div>

        </div>



        <div class="row d-flex justify-content-center pt-3" id="select_animals_to_breed">



        </div>

        <div class="row d-flex justify-content-center pt-3">

            <div class="col-auto">

                <a href="#" class="btn btn-primary" id="start_mating">Animal mating</a>

            </div>
        </div>

    </div>

    <div id="new_animal_popup">

    </div>

    <script>

        window.onload = function () {
            updateCompatiblePartners('');
        }

        let select_breed = document.getElementById('select_breed')
        let select_male = document.getElementById('select_male')
        let select_female = document.getElementById('select_female')
        let start_mating = document.getElementById('start_mating')


        // Event listener on breed selection
        select_breed.addEventListener('change', () => {

            if (select_breed.value != 'Select breed') {
                updateCompatiblePartners(select_breed.value)
                // Make male and female select enabled if breed chosen
                select_male.disabled = false
                select_female.disabled = false

            } else {
                updateCompatiblePartners('')
                // Make male and female select disabled if no breed chosen
                select_male.disabled = true
                select_female.disabled = true
            }
        })


        // When button clicked
        start_mating.addEventListener('click', () => {

            // Get values breed, male and female from select
            let breed = document.getElementById('select_breed').value
            let male = document.getElementById('select_male').value
            let female = document.getElementById('select_female').value

            // If there is a valid input for each id, create new animal
            if (breed > 0 && male > 0 && female > 0) {

                createNewAnimal(breed, male, female)

            } else {

                console.log('Data missing')
            }


        })



        // AJAX function for creating new animal
        function createNewAnimal(id_breed, id_father, id_mother) {
            $.ajax({
                type: "POST",
                url: "ajax_queries/create_new_animal.php",
                data: {
                    id_breed: id_breed,
                    id_father: id_father,
                    id_mother: id_mother
                },
                // If the ajax query returns a success, display pop-up
                // and remove the content in the background
                success: function (data) {

                    let new_animal_popup = document.getElementById("new_animal_popup");
                    new_animal_popup.innerHTML = data;

                    let main_content = document.getElementById("main-content")
                    main_content.remove()
                }
            });
        }


        // AJAX function for filtering by breed
        function updateCompatiblePartners(id_breed) {
            $.ajax({
                type: "POST",
                url: "ajax_queries/update_compatible_partners.php",
                data: {
                    breed: id_breed,
                },
                // If the ajax query returns a success, update the table
                success: function (data) {
                    let compatible_partners = document.getElementById("select_animals_to_breed")
                    compatible_partners.innerHTML = data
                }
            });
        }

    </script>

    <?php

} else {
    header("Location: index.php?page=login");
}
?>