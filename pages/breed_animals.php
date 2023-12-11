<h3>Generate population evolution</h3>

<?php
if (isset($_SESSION['open']) && $_SESSION['open'] > 0) {
    $animal = new Animal();
    ?>

    <div class="row">
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

    <div class="row" id="select_animals_to_breed">



    </div>

    <div class="row">

        <div class="col-auto">

            <button class="button" type="submit" name="start_mating"  id="start_mating">Animal mating</button>

        </div>
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

            console.log(select_breed.value)
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
            console.log("Mating clicked")
             // Get values male and female from select
            let male = document.getElementById('select_male').value
            let female = document.getElementById('select_female').value


            // Insert ajax call to create new animal
            

        })




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
                    let compatible_partners = document.getElementById("select_animals_to_breed");
                    compatible_partners.innerHTML = data;
                }
            });
        }

    </script>

    <?php

} else {
    header("Location: index.php?page=login");
}
?>