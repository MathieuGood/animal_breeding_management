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


    <script src="scripts/breed_animals_scripts.js"></script>

    
    <?php

} else {
    header("Location: index.php?page=login");
}
?>