<?php

// dbConnect class to connect to the MariaDB database

class dbConnect
{
    private $host;
    private $dbname;
    private $user;
    private $passw;
    private $connect;

    // Connection parameters
    public function __construct($h = 'localhost', $db = 'breedingManager', $u = 'mariadb', $pw = 'mariadb*1')
    {
        $this->connect = new PDO("mysql:host=" . $h . ";dbname=" . $db, $u, $pw);
        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Method to check a query to avoid SQL injection and send it to the database
    public function sendQuery($query, $fetch_type = "both")
    {
        $startquery = explode(' ', trim($query));
        // Only allow SELECT, INSERT, UPDATE, DELETE and CALL queries
        if ($startquery[0] == 'SELECT' || $startquery[0] == 'INSERT' || $startquery[0] == 'UPDATE' || $startquery[0] == 'DELETE' || $startquery[0] == 'CALL') {

            $result = $this->connect->query($query);

            // In case of a SELECT query, fetch the results
            if ($startquery[0] == 'SELECT' || str_contains($startquery[1], 'get')) {

                if ($fetch_type == "num") {
                    $result = $result->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    $result = $result->fetchAll();
                }
            }


            if ($startquery[0] == 'INSERT') {
                // In case of an INSERT query, return the last inserted ID
                $result = $this->connect->lastInsertId();

            } else if (str_contains($startquery[1], 'create')) {
                // In the particular calling createRandomAnimal() procedure, get the last inserted ID with a different query

                $result = $this->connect->query("SELECT MAX(id_animal) AS last_insert FROM animal");
                $result = $result->fetchAll(PDO::FETCH_ASSOC)[0]['last_insert'];

            }
            return $result;
        } else {
            return FALSE;
        }
    }


    // Insert multiple values in a table in one query
    // Method format : insertMultiple($table, ['col1', 'col2', 'col3,], ['value1', value2', 'value3'])
    public function insertMultiple($table, $cols, $values)
    {

        $cols_list = '';
        foreach ($cols as $col) {
            $cols_list = $cols_list . "`" . $col . "`, ";
        }
        $cols_list = rtrim($cols_list, ", ");

        $values_list = '';
        foreach ($values as $value) {
            $values_list = $values_list . '"' . $value . '", ';
        }
        $values_list = rtrim($values_list, ", ");

        $query = "INSERT INTO `" . $table . "` (" . $cols_list . ") VALUES (" . $values_list . ")";

        $result = $this->sendQuery($query);

        return $result;
    }

    public function update($table, $id, $col, $value)
    {
        $query = "UPDATE `" . $table . "` SET `" . $col . "` = '" . $value . "' WHERE `id_" . $table . "` = '" . $id . "'";

        $this->sendQuery($query);
    }

    // Get the column names of a table
    public function getColumnNames($table)
    {
        $query = "SELECT id_column_label, label
                    FROM (SELECT DISTINCT COLUMN_NAME 
                            FROM INFORMATION_SCHEMA.COLUMNS 
                            WHERE TABLE_NAME = '" . $table . "')
                            as ids
                         INNER JOIN column_label
                                 ON ids.COLUMN_NAME = column_label.id_column_label;";
        return $this->sendQuery($query);
    }
}

?>