<?php

class dbConnect {

    // Paramètres
    private $host;
    private $dbname;
    private $user;
    private $passw;
    private $connect;

    // Constructeur
    public function __construct($h='localhost', $db='breedingManagement', $u='mariadb', $pw='mariadb*1') {
        $this->connect = new PDO("mysql:host=".$h.";dbname=".$db, $u, $pw);
        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Execution requête
    public function sendQuery($query) {
        $startquery = explode(' ', trim($query));
        if ($startquery[0] == 'SELECT' || $startquery[0] == 'INSERT' || $startquery[0] == 'UPDATE' || $startquery[0] == 'DELETE') {
            // Exécution
            $result = $this->connect->query($query);
            // Traitement du résultat
            // Dans le cas d'un SELECT, on convertit le résulat de la queryuête en tableau PHP
            if ($startquery[0] == 'SELECT') $result = $result->fetchAll(PDO::FETCH_ASSOC);
            // Dans le cas d'un INSERT, on récupère l'id du nouvel élément créé dans la base
            if ($startquery[0] == 'INSERT') {
                $result = $this->connect->lastInsertId(); 
                echo "lastInsertId is ".$result."<br />";
            }
            // Renvoi du résultat
            return $result;
        } else {
            return FALSE;
        }
    }

    // Alternative insert function
    public function create($table) {
        $query = "INSERT INTO `".$table."` (`id_".$table."`) VALUES (NULL)";
        return $this->sendQuery($query);
    }

    // Insert
    // execInsert($table, ['col1', 'col2', 'col3,], ['value1', value2', 'value3'])
    public function execInsert($table, $cols, $values) {
        // Boucle sur l'array $cols qui contient toutes les colonnes à traiter
        // On transforme l'array en une string au bon format pour la requête SQL
        // Format de sortie : `col1`, `col2`, `col3`
        $cols_list = '';
        foreach ($cols as $col) {
            $cols_list = $cols_list."`".$col."`, ";
        }
        $cols_list = rtrim($cols_list, ", ");
        // For debugging
        // echo "Columns list : ".$cols_list."<br />";

        // Même principe sur l'array $values
        // Format de sortie : "value1", "value2", "value3"
        $values_list = '';
        foreach ($values as $value) {
            $values_list = $values_list.'"'.addslashes($value).'", ';
        }
        $values_list = rtrim($values_list, ", ");
        // echo "Values list : ".$values_list."<br />";

        $query = "INSERT INTO `".$table."` (".$cols_list.") VALUES (".$values_list.")";

        // For debugging
        // echo "<br />INSERT >>>><br />";
        // echo "SQL Query : ".$query."<br />";

        $result = $this->sendQuery($query);
        return $result[0][0];
    }
    
    // Setter pour UPDATE
    public function update($table, $id, $col, $value) {
        // Previous version
        // $query = 'UPDATE `'.$table.'` SET `'.$col.'` = "'.addslashes($value).'" WHERE `id_'.$table.'` = '.$id;
        $query = "UPDATE `".$table."` SET `".$col."` = '".addslashes($value)."' WHERE `id_".$table."` = ".$id;
        echo $query;
        // For debugging
        // echo "<br />UPDATE >>>><br />";
        // echo "SQL Query : ".$query."<br />";
        $this->sendQuery($query);
    }

    // Get
    public function select($table, $id, $col) {
        $query = "SELECT `".$col."` FROM `".$table."` WHERE `id_".$table."` = ".$id;
        $result = $this->sendQuery($query);
        var_dump($result);
        return stripslashes($result[0][0]);
    }

    public function getColumnNames($table) {
        $query = "SELECT label
                    FROM (SELECT DISTINCT COLUMN_NAME 
                            FROM INFORMATION_SCHEMA.COLUMNS 
                            WHERE TABLE_NAME = '".$table."')
                            as ids
                         INNER JOIN column_label
                                 ON ids.COLUMN_NAME = column_label.id_column_label;";
        return $this->sendQuery($query);
    }

    public function getInputType($table, $column_name) {
        $query = "SELECT html_input_type
                    FROM column_label
                    WHERE id_column_label = '".$column_name."'";
        return $this->sendQuery($query);
    }

    public function getColumnNamesAndInputType($table) {
        $query = "SELECT label, html_input_type
                    FROM (SELECT DISTINCT COLUMN_NAME 
                            FROM INFORMATION_SCHEMA.COLUMNS 
                            WHERE TABLE_NAME = '".$table."')
                            as ids
                         INNER JOIN column_label
                                 ON ids.COLUMN_NAME = column_label.id_column_label;";
        return $this->sendQuery($query);
    }

}
?>