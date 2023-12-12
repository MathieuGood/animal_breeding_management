<?php

$id = $_GET['id'];

if (isset($_SESSION['open']) && $_SESSION['open'] > 0 && isset($id)) {

    $animal = new Animal($id);

    $animal_data = $animal->getAnimalDetails();
    // var_dump($animal_data);


    $father_data = $animal->getParentDetails('father', $id);
    if ($father_data) {
        $father_data['relative'] = 'father';
    }

    $mother_data = $animal->getParentDetails('mother', $id);
    if ($mother_data) {
        $mother_data['relative'] = 'mother';
    }


    $parents = [
        $father_data,
        $mother_data
    ];

    $grandparents = [];

    if (isset($father_data['id_animal'])) {
        $fatherside_grandfather_data = $animal->getParentDetails('father', $father_data['id_animal']);
        if ($fatherside_grandfather_data) {
            $fatherside_grandfather_data['relative'] = 'grandfather';
            $fatherside_grandfather_data['family_side'] = 'father';
            array_push($grandparents, $fatherside_grandfather_data);
        } else {
            $fatherside_grandfather_data = '';
        }

        $fatherside_grandmother_data = $animal->getParentDetails('mother', $father_data['id_animal']);
        if ($fatherside_grandmother_data) {
            $fatherside_grandmother_data['relative'] = 'grandmother';
            $fatherside_grandmother_data['family_side'] = 'father';
            array_push($grandparents, $fatherside_grandmother_data);
        } else {
            $fatherside_grandmother_data = '';
        }
    }

    if (isset($mother_data['id_animal'])) {
        $motherside_grandfather_data = $animal->getParentDetails('father', $mother_data['id_animal']);
        if ($motherside_grandfather_data) {
            $motherside_grandfather_data['relative'] = 'grandfather';
            $motherside_grandfather_data['family_side'] = 'mother';
            array_push($grandparents, $motherside_grandfather_data);
        } else {
            $motherside_grandfather_data = '';
            
        }

        $motherside_grandmother_data = $animal->getParentDetails('mother', $mother_data['id_animal']);
        if ($motherside_grandmother_data) {
            $motherside_grandmother_data['relative'] = 'grandmother';
            $motherside_grandmother_data['family_side'] = 'mother';
            array_push($grandparents, $motherside_grandmother_data);
        } else {
            $motherside_grandmother_data = '';
        }
    }


    // Build one html animal presentation card for genealogy display
    // Input value $animal_data is the return of getAnimalDetails, getParentDetails, getChildrenDetails
    function buildAnimalCard($animal_data, $image = '')
    {
        // Check if there is data
        if ($animal_data) {

            // If a family side is specified, include it and capitalize the string
            if (isset($animal_data['family_side'])) {
                $family_side = '<br>' . ucfirst($animal_data['family_side']) . '\'s side';
            } else {
                $family_side = '';
            }

            // If a relative name is specified, include it and capitalize the string
            if (isset($animal_data['relative'])) {
                $relative = ucfirst($animal_data['relative']);
            } else {
                $relative = '';
            }

            if ($family_side != '' || $relative != '') {
                $add_header = '
                <p class="card-text card-topinfo">
                ' . $relative . '
                ' . $family_side . '        
                </p>
                ';
            } else {
                $add_header = '';
            }

            if ($image != '') {
                $add_image = '<div class="card-topinfo"><img src="' . $image . '" class="card-custom-img img-fluid"></div>';
            } else {
                $add_image = '';
            }

            echo '
        <div class="animal-card card text-center mb-3 mx-2">
        <div class="card-body">

                ' . $add_header . '
                ' . $add_image . '        
            
            <h5 class="card-title">
                <span id="snake_name">
                ' . $animal_data['animal_name'] . '
                </span>
            </h5>

            <p class="card-text">

            <ul>

                <li>Birth :
                    ' . $animal_data['birth_time'] . '
                </li>

                <li>Death :
                    ' . $animal_data['death_time'] . '
                </li>

            </ul>

            </p>

        </div>
    </div>
        ';

        }

    }

    ?>



    <div class="container" id="main-content">


        <h3>Genealogy</h3>


        <!--  -->
        <!-- Grandparents -->
        <!--  -->

        <div id="grandparents" class="row flex-row justify-content-center">


            <?php

            foreach ($grandparents as $grandparent) {

                if ($grandparent) {
                    buildAnimalCard($grandparent);
                }
            }

            ?>

        </div>



        <!--  -->
        <!-- Parents -->
        <!--  -->
        <div id="parents" class="row d-flex justify-content-center flex-row">
            <?php
            foreach ($parents as $parent) {

                if ($parent) {
                    buildAnimalCard($parent);
                }
            }
            ?>
        </div>




        <!--  -->
        <!-- Parents -->
        <!--  -->

        <div id="current_animal" class="row d-flex justify-content-center flex-row">

            <?php

            buildAnimalCard($animal_data, 'images/snake_looking_right.svg');

            ?>
        </div>





        <!--  -->
        <!-- Children -->
        <!--  -->


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