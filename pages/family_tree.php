<?php

$id = $_GET['id'];

if (isset($_SESSION['open']) && $_SESSION['open'] > 0 && isset($id)) {

    $animal = new Animal($id);

    $animal_data = $animal->getAnimalDetails();
    // var_dump($animal_data);
    $animal_data['birth_time'] = $animal_data['birth_time_formatted'];
    $animal_data['death_time'] = $animal_data['death_time_formatted'];


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


    $children = $animal->getChildrenDetails($id);

    foreach ($children as $key => $child) {
        $children[$key]['relative'] = 'child';
    }

    ?>



    <div class="container" id="main-content">


        <h3>Genealogy</h3>


        <!--  -->
        <!-- Grandparents -->
        <!--  -->

        <div id="grandparents" class="row flex-row justify-content-center">


            <?php
            $count = 0;
            foreach ($grandparents as $grandparent) {
                
                if ($grandparent) {
                    $animal->buildAnimalCard($grandparent, '', $count);
                    $count++;
                }
            }

            ?>

        </div>



        <!--  -->
        <!-- Parents -->
        <!--  -->
        <div id="parents" class="row d-flex justify-content-evenly flex-row">
            <?php
            foreach ($parents as $parent) {

                if ($parent) {
                    $animal->buildAnimalCard($parent);
                }
            }
            ?>
        </div>




        <!--  -->
        <!-- Current animal -->
        <!--  -->

        <div id="current_animal" class="row d-flex justify-content-center flex-row">

            <?php

            $animal->buildAnimalCard($animal_data, 'images/snake_looking_right.svg');

            ?>
        </div>





        <!--  -->
        <!-- Children -->
        <!--  -->


        <div class="row d-flex justify-content-center" id="children">

            <?php
            foreach ($children as $child) {

                if ($child) {
                    $animal->buildAnimalCard($child);
                }
            }
            ?>

        </div>


    </div>



    <?php

} else {
    header("Location: index.php?page=login");
}
?>