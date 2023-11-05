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
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="stylesheet" href="node_modules/dracula-ui/styles/dracula-ui.css" />
        <title><?php echo ucfirst($_SESSION['animal_specie']) ?> Breeding Management</title>
    </head>
    <body>
        <div class="drac-box drac-bg-black-secondary drac-rounded-lg drac-p-xs">
            <h1 class="drac-heading drac-heading-xl drac-text-white"><?php echo ucfirst($_SESSION['animal_specie']) ?> Breeding Management</h1>
        </div>
        <?php
            include('menu.php');
        ?>
        <div id="container">
        <?php

        // La chaîne de caractères $_GET['page'] doit correspondre exactement au nom du fichier
        // isset() -> Vérifie que la variable existe
            if (!isset($_GET['page']) || $_GET['page'] == '') $_GET['page'] = 'login';
            $file_import = 'pages/'.$_GET['page'].'.php';
            if (file_exists($file_import)) {
                include($file_import);
            } else {
                echo "Page ".$file_import." is not available";
            }
        ?>
        </div>
    </body>
</html>