<?php

$id = $_GET['id'];

if (isset($_SESSION['open']) && $_SESSION['open'] > 0 && isset($id)) {
    $animal = new Animal($id);

    $animal_data = $animal->getAnimalDetails();
    // var_dump($animal_data);

    $father_data = $animal->getParentDetails('father', $id);

    $mother_data = $animal->getParentDetails('mother', $id);

    echo "<br>Father : <br>";
    var_dump($father_data);
    echo '<br>';

    echo "<br>Mother : <br>";
    var_dump($mother_data);
    echo '<br>';

    ?>

    <div class="container" id="main-content">


        <h3>Genealogy</h3>


        <!--  -->
        <!-- Grandparents -->
        <!--  -->

        <div id="grandparents" class="row d-flex justify-content-center">

            <!--  -->
            <!-- Father : Grandparents -->
            <!--  -->
            <div id="parents" class="row d-flex justify-content-center flex-row">

                <!--  -->
                <!-- Father : Grandfather -->
                <!--  -->
                <div class="animal-card card text-center mb-3 mx-2">
                    <div class="card-body">

                        <h5 class="card-title">
                            <span id="snake_name">
                                Father : Grandfather
                            </span>
                        </h5>
                        <p class="card-text">
                            <?php echo $animal_data['breed_name'] ?>
                        </p>
                        <p class="card-text">
                        <ul>
                            <li>Birth :
                                <?php echo $animal_data['birth_time'] ?>
                            </li>
                            <li>Death :
                                <?php echo $animal_data['death_time'] ?>
                            </li>
                        </ul>
                        </p>

                    </div>
                </div>


                <!--  -->
                <!-- Father : Grandmother -->
                <!--  -->
                <div class="animal-card card text-center mb-3 mx-2">
                    <div class="card-body">

                        <h5 class="card-title">
                            <span id="snake_name">
                                Father : Grandmother
                            </span>
                        </h5>
                        <p class="card-text">
                            <?php echo $animal_data['breed_name'] ?>
                        </p>
                        <p class="card-text">
                        <ul>
                            <li>Birth :
                                <?php echo $animal_data['birth_time'] ?>
                            </li>
                            <li>Death :
                                <?php echo $animal_data['death_time'] ?>
                            </li>
                        </ul>
                        </p>

                    </div>
                </div>

            </div>
        </div>


        <!--  -->
        <!-- Mother : Grandparents -->
        <!--  -->
        <div id="parents" class="row d-flex justify-content-center flex-row">

            <!--  -->
            <!-- Mother : Grandfather -->
            <!--  -->
            <div class="animal-card card text-center mb-3 mx-2">
                <div class="card-body">

                    <h5 class="card-title">
                        <span id="snake_name">
                            Mother : Grandfather
                        </span>
                    </h5>
                    <p class="card-text">
                        <?php echo $animal_data['breed_name'] ?>
                    </p>
                    <p class="card-text">
                    <ul>
                        <li>Birth :
                            <?php echo $animal_data['birth_time'] ?>
                        </li>
                        <li>Death :
                            <?php echo $animal_data['death_time'] ?>
                        </li>
                    </ul>
                    </p>

                </div>
            </div>


            <!--  -->
            <!-- Mother : Grandmother -->
            <!--  -->
            <div class="animal-card card text-center mb-3 mx-2">
                <div class="card-body">

                    <h5 class="card-title">
                        <span id="snake_name">
                            Mother : Grandmother
                        </span>
                    </h5>
                    <p class="card-text">
                        <?php echo $animal_data['breed_name'] ?>
                    </p>
                    <p class="card-text">
                    <ul>
                        <li>Birth :
                            <?php echo $animal_data['birth_time'] ?>
                        </li>
                        <li>Death :
                            <?php echo $animal_data['death_time'] ?>
                        </li>
                    </ul>
                    </p>

                </div>
            </div>

        </div>
    </div>

    </div>


    <!--  -->
    <!-- Parents -->
    <!--  -->
    <div id="parents" class="row d-flex justify-content-center flex-row">

        <!--  -->
        <!-- Father -->
        <!--  -->
        <div class="animal-card card text-center mb-3 mx-2">
            <div class="card-body">

                <h5 class="card-title">
                    <span id="snake_name">
                        Father name
                    </span>
                </h5>
                <p class="card-text">
                    <?php echo $animal_data['breed_name'] ?>
                </p>
                <p class="card-text">
                <ul>
                    <li>Birth :
                        <?php echo $animal_data['birth_time'] ?>
                    </li>
                    <li>Death :
                        <?php echo $animal_data['death_time'] ?>
                    </li>
                </ul>
                </p>

            </div>
        </div>


        <!--  -->
        <!-- Mother -->
        <!--  -->
        <div class="animal-card card text-center mb-3 mx-2">
            <div class="card-body">

                <h5 class="card-title">
                    <span id="snake_name">
                        Mother name
                    </span>
                </h5>
                <p class="card-text">
                    <?php echo $animal_data['breed_name'] ?>
                </p>
                <p class="card-text">
                <ul>
                    <li>Birth :
                        <?php echo $animal_data['birth_time'] ?>
                    </li>
                    <li>Death :
                        <?php echo $animal_data['death_time'] ?>
                    </li>
                </ul>
                </p>

            </div>
        </div>

    </div>
    </div>


    <!--  -->
    <!--  -->
    <!-- Curent animal -->
    <!--  -->
    <!--  -->
    <div class="row d-flex justify-content-center" id="current_animal">

        <div class="col-auto">

            <div class="animal-card card text-center mb-3 mx-2">
                <div class="card-body">

                    <h5 class="card-title">
                        <span id="snake_name">
                            <?php echo $animal_data['animal_name'] ?>
                        </span>
                    </h5>
                    <p class="card-text">
                        <?php echo $animal_data['breed_name'] ?>
                    </p>
                    <p class="card-text">
                    <ul>
                        <li>Birth :
                            <?php echo $animal_data['birth_time'] ?>
                        </li>
                        <li>Death :
                            <?php echo $animal_data['death_time'] ?>
                        </li>
                    </ul>
                    </p>

                </div>
            </div>

        </div>



        <div class="row d-flex justify-content-center" id="children">

            <div class="col-auto">

            </div>

        </div>


    </div>



    <?php

} else {
    header("Location: index.php?page=login");
}
?>