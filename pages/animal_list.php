<?php
// If the user is logged in
if (isset($_SESSION['open']) && $_SESSION['open'] > 0) {

    // If $_GET['choice'] exists and is equal to 'deceased', 
    if (isset($_GET['choice']) && $_GET['choice'] == 'deceased') {
        $_SESSION['alive'] = false;
        $title = 'Deceased animals list';
    } else {
        $_SESSION['alive'] = true;
        $title = 'Animal list';
    }

    // On page load, reset all filters, sorting and pagination stored in $_SESSION
    include('components/reset_search_parameters.php');

    // Instantiate new Animal object
    $animal = new Animal();

    if (isset($_POST['random_animal'])) {
        $animal->createRandomAnimal($_POST['amount_to_create']);
    }
    ?>

    <h3>
        <?php echo $title ?>
    </h3>

    <div class="page-content d-flex flex-column justify-content-center">

        <div class="container row top-part">

            <?php

            if ($_SESSION['alive'] == true) {
                ?>

                <div class="create_animal col-sm-auto">

                    <input class="btn btn-primary" style="width:100%; margin:0.3em 0 0.5em 0;" type="button"
                        onclick="window.location.href='index.php?page=edit_animal&choice=new'"
                        value="Add new custom <?php echo $_SESSION['animal_specie'] ?>">

                    <span class="create_multiple_animals">

                        <form id="create_multiple_animals" method="POST" action="">

                            <input type=number step="1" min="1" max="1000" name="amount_to_create" value="1">
                            <input class="btn btn-primary" style="width:auto; margin:0" type="submit" name="random_animal"
                                value="Create random <?php echo $_SESSION['animal_specie_plural'] ?> ">

                        </form>

                    </span>

                </div>
                <?php
            }
            ?>

            <div class="snake_count col-sm-auto">
                <?php

                // Display the total number of animals
                $sex_count = $animal->countAllAnimalsBySex($_SESSION['alive']);

                if ($sex_count != []) {

                    if (!isset($sex_count[0]['count'])) {
                        $male_count = 0;
                    } else {
                        $male_count = $sex_count[0]['count'];
                    }
                    if (!isset($sex_count[1]['count'])) {
                        $female_count = 0;
                    } else {
                        $female_count = $sex_count[1]['count'];
                    }
                } else {
                    $male_count = 0;
                    $female_count = 0;
                }

                $total_count = $male_count + $female_count;

                ?>
                <h6>
                    <?php echo ucfirst($_SESSION['animal_specie']) . " total count : " . $total_count; ?>
                </h6>

                <h6>
                    Male :
                    <?php echo $male_count ?>
                </h6>

                <h6>
                    Female :
                    <?php echo $female_count ?>
                </h6>

            </div>


        </div>

        <span class="pt-2">
            <!-- Name filter -->
            <input type="text" name="name_filter" id="name_filter" placeholder="Name search">

        </span>

        <div id="animal_list">

            <!-- List of animals -->

        </div>


        <script src="scripts/animal_list_scripts.js"></script>

        <?php
} else {
    // If the user is not logged in, redirect to login page
    header("Location: index.php?page=login");
}
?>