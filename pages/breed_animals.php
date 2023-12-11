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

        <!-- <div class="col-auto">

            <select name='male_animal' id='select_male' value="---" disabled>
                <option>Select male animal</option>
                <?php
                // Get the list of all male animal names
                $males = $animal->getAllCompatiblePartners('M');

                foreach ($males as $male) {
                    echo '<option value="' . $male['id_animal'] . '">
                            #' . $male['id_animal'] . ' ' . $male['animal_name'] . ' > ' . $male['breed_name'] .
                        '</option>';
                }
                ?>

            </select>

        </div>


        <div class="col-auto">

            <select name='female_animal' id='select_female' value="---" disabled>
                <option value='0'>Select female animal</option>
                <?php
                // Get the list of all male animal names
                $females = $animal->getAllCompatiblePartners('F');

                foreach ($females as $female) {
                    echo '<option ';
                    echo 'value="' . $female['id_animal'] . '">
                     #' . $female['id_animal'] . ' ' . $female['animal_name'] . ' > ' . $female['breed_name'] . '</option>';
                }
                ?>
            </select>

        </div> -->

    </div>

    <div class="row">

        <div class="col-auto">

            <input class="button" type="submit" name="start_mating" value="Animal mating">

        </div>
    </div>

    <script>

        window.onload = function () {
            updateCompatiblePartners('');
        }

        let select_breed = document.getElementById('select_breed')
        let select_male = document.getElementById('select_male')
        let select_female = document.getElementById('select_female')


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

        select_male.addEventListener('change', () => {
            // updateCompatiblePartners(select_male.value)
            console.log(select_male.value)
        })

        select_female.addEventListener('change', () => {
            // updateCompatiblePartners(select_male.value)
            console.log(select_female.value)
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