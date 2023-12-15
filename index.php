<?php
session_start();
require_once('classes/dbconnect.class.php');
require_once('classes/user.class.php');
require_once('classes/animal.class.php');

$_SESSION['animal_specie'] = "snake";
$_SESSION['animal_specie_plural'] = "snakes";
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <!-- Bootstrap import -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="scripts/ajax_functions.js"></script>

    <link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="icon" href="images/snake.ico" />
    <title>
        <?php echo ucfirst($_SESSION['animal_specie']) ?> Breeding Manager
    </title>
</head>

<body>
    <!-- jQuery import -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <?php
    include('menu.php');
    ?>
    <div class="container" id="main_content">
            <?php

            // Router
            if(!isset($_GET['page']) || $_GET['page'] == '')
                $_GET['page'] = 'login';
            $file_import = 'pages/'.$_GET['page'].'.php';
            if(file_exists($file_import)) {
                include($file_import);
            } else {
                echo "Page ".$file_import." is not available";
            }
            ?>
    </div>
</body>

</html>