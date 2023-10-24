<?php

class User {

    private $table = "user";
    private $id = "";

    public function __construct($my_id="nothing") {
        if ($my_id != "nothing" and $my_id != "new_entry") $this->id = $my_id;
        if ($my_id == "new_entry") {
            $db_connect = new dbConnect();
            $this->id = $db_connect->create($this->table);
        }
    }
    
    public function get($col) {
        $db_connect = new dbConnect();
        return $db_connect->select($this->table, $this->id, $col);
    }

    public function set($col, $value) {
        $db_connect = new dbConnect();
        return $db_connect->execUpdate($this->table, $this->id, $col, $value);
    }

    public function delete($id) {
        $db_connect = new dbConnect();
        $req = "DELETE FROM `".$this->table."` WHERE `id_".$this->table."` = '".$id."'";
        $db_connect->sendQuery($req);
    }

    public function countUsers() {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery("SELECT COUNT(*) as count_table FROM `".$this->table."`");
    }

    // Récupère prénom + nom à partir du usr_name
    public function getFullName($usr_name) {
        $db_connect = new dbConnect();
        $requete = "SELECT `firstname`, `lastname` FROM `".$this->table."` WHERE user_name = '".$usr_name."'";
        $result = $db_connect->sendQuery($requete);
        return $result[0][0]." ".$result[0][1];
    }

    public function getFullInfo() {
        $db_connect = new dbConnect();
        $requete = "SELECT * FROM `".$this->table."`";
        return $db_connect->sendQuery($requete);
    }

    public function selectAll() {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery("SELECT * FROM `".$this->table."`");
    }

    public function checkIfPwdIsCorrect($usr_name, $pwd) {
        $db_connect = new dbConnect();
        $result = $db_connect->sendQuery('SELECT `user_password` FROM `'.$this->table.'` WHERE `user_login` = "'.$usr_name.'"');
        if ($result != array() && $result[0]['user_password'] == $pwd) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getIdFromUserName($usr_name) {
        $db_connect = new dbConnect();
        return $db_connect->sendQuery('SELECT id_'.$table.' FROM `'.$this->table.'` WHERE user_name = "'.$usr_name.'"');
    }

    // Retourne le nombre de usr_name égalant $usr_name en omettant le usr_name actuel du $id_to_exclude renseigné
    public function checkIfUserNameExists($id_to_exclude, $usr_name=-1) {
        $db_connect = new dbConnect();
        $query_select = 'SELECT COUNT(*) FROM `'.$this->table.'` WHERE usr_name = "'.$usr_name.'"';
        $query_and = ' AND id_'.$this->table.' != "'.$id_to_exclude.'"';
        $query = $query_select.$query_and;
        return $db_connect->sendQuery($query)[0][0];
    }


}


?>