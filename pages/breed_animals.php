<h3>Generate population evolution</h3>

<?php
if (isset($_SESSION['open']) && $_SESSION['open'] > 0) {
    $animal = new Animal();
    ?>

    <div class="row">

        <div class="col-auto">

            <select name='male_animal' id='select_male' value="---">
                <option>Select male animal</option>
                <?php
                // Get the list of all male animal names
                $males = $animal->getAllCompatiblePartners('M', $id = '');

                foreach ($males as $male) {
                    echo '<option value="' . $male['id_animal'] . '">
                            #' . $male['id_animal'] . ' ' . $male['animal_name'] . ' > ' . $male['breed_name'] . 
                        '</option>';
                }
                ?>

            </select>

        </div>


        <div class="col-auto">

            <select name='female_animal' id='select_female' value="---">
                <option value='0'>Select female animal</option>
                <?php
                // Get the list of all male animal names
                $females = $animal->getAllCompatiblePartners('F', $id = '');

                foreach ($females as $female) {
                    echo '<option ';
                    echo 'value="' . $female['id_animal'] . '">
                     #' . $female['id_animal'] . ' ' . $female['animal_name'] . ' > ' . $female['breed_name'] . '</option>';
                }
                ?>
            </select>

            <div class="row">

                <input class="button" type="submit" name="start_mating" value="Animal mating">

            </div>

        </div>

    </div>
    
    <script>

        let select_male = document.getElementById('select_male')
        console.log(select_male)
        let select_female = document.getElementById('select_female')
        console.log(select_female)    
        
        select_male.addEventListener('change', () => {
            // updateCompatiblePartners(select_male.value)
            console.log(select_male.value)
        })

        select_female.addEventListener('change', () => {
            // updateCompatiblePartners(select_male.value)
            console.log(select_female.value)
        })



        </script>

    <?php

} else {
    header("Location: index.php?page=login");
}
?>