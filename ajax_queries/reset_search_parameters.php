<?php
// Reset all the search parameters from animal_list.php stored in SESSION
$_SESSION['sort'] = 'id_animal ASC';
$_SESSION['name_filter'] = '';
$_SESSION['breed_filter'] = '';
$_SESSION['sex_filter'] = '';
$_SESSION['current_page'] = 1;
$_SESSION['rows_per_page'] = 10;
echo "Resetting session parameters :<br>";
var_dump($_SESSION);
?>