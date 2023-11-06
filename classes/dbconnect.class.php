<?php

class dbConnect {

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
    public function sendQuery($query, $fetch_type="both") {
        $startquery = explode(' ', trim($query));
        if ($startquery[0] == 'SELECT' || $startquery[0] == 'INSERT' || $startquery[0] == 'UPDATE' || $startquery[0] == 'DELETE' || $startquery[0] == 'CALL') {
            // Exécution
            $result = $this->connect->query($query);
            // Traitement du résultat
            // Dans le cas d'un SELECT, on convertit le résulat de la queryuête en tableau PHP
            if ($startquery[0] == 'SELECT') {
                if ($fetch_type == "num") {
                    $result = $result->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    $result = $result->fetchAll();
                }
            }
            // Dans le cas d'un INSERT, on récupère l'id du nouvel élément créé dans la base
            if ($startquery[0] == 'INSERT' || $startquery[0] == 'CALL') {
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
    public function insert($table, $col, $value) {
        $query = "INSERT INTO `".$table."` (`".$col."`) VALUES ('".$value."')";
        return $this->sendQuery($query);
    }

    // Insert
    // execInsert($table, ['col1', 'col2', 'col3,], ['value1', value2', 'value3'])
    public function insertMultiple($table, $cols, $values) {
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
            $values_list = $values_list.'"'.$value.'", ';
        }
        $values_list = rtrim($values_list, ", ");
        // echo "Values list : ".$values_list."<br />";

        $query = "INSERT INTO `".$table."` (".$cols_list.") VALUES (".$values_list.")";

        // For debugging
        echo "SQL Query : ".$query."<br />";

        $result = $this->sendQuery($query);
        return $result[0][0];
    }
    
    public function update($table, $id, $col, $value) {
        $query = "UPDATE `".$table."` SET `".$col."` = '".$value."' WHERE `id_".$table."` = '".$id."'";

        // For debugging
        echo $query."<br>";
 
        $this->sendQuery($query);
    }

    // Get
    public function select($table, $id, $col) {
        $query = "SELECT `".$col."` FROM `".$table."` WHERE `id_".$table."` = ".$id;
        $result = $this->sendQuery($query);
        var_dump($result);
        return $result[0][0];
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