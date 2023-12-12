<?php

$id = $_GET['id'];

if (isset($_SESSION['open']) && $_SESSION['open'] > 0 && isset($id)) {
    $animal = new Animal($id);
    ?>

    <div class="container" id="main-content">

        <h3>Genealogy</h3>


        <div class="row" id="grandparents">

            <div class="col-auto">


            </div>

        </div>



        <div class="row" id="current_animal">

            <div class="col-auto">


            </div>

        </div>
        


        <div class="row" id="children">

            <div class="col-auto">


            </div>

        </div>

    </div>



    <?php

} else {
    header("Location: index.php?page=login");
}
?>