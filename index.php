<?php
    session_start();
    // Imoprt de bdd.class avant users.class car le premier utilise le second
    require_once('classes/bdd.class.php');
    require_once('classes/users.class.php');
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" type="text/css" />
        <title>Élevage de serpents</title>
    </head>
    <body>
        <h1>Élevage de serpents</h1>
        <?php
            include('menu.php');
        ?>
        <div id="content">
        <?php
        // La chaîne de caractères $_GET['page'] doit correspondre exactement au nom du fichier
        // isset() -> Vérifie que la variable existe
            if (!isset($_GET['page']) || $_GET['page'] == '') $_GET['page'] = 'accueil';
            $file_import = 'pages/'.$_GET['page'].'.php';
            if (file_exists($file_import)) {
                include($file_import);
            } else {
                echo "La page ".$file_import." n'est pas disponible.";
            }
        ?>
        </div>
        <footer></footer>
    </body>
</html>