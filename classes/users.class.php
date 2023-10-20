<?php

class Users {

    private $table = "users";
    private $id = "";

    public function __construct($my_id="nothing") {
        if ($my_id != "nothing" and $my_id != "new_entry") $this->id = $my_id;
        if ($my_id == "new_entry") {
            $db_connect = new Bdd();
            $this->id = $db_connect->create($this->table);
        }
    }
    
    public function get($col) {
        $db_connect = new Bdd();
        return $db_connect->select($this->table, $this->id, $col);
    }

    public function set($col, $value) {
        $db_connect = new Bdd();
        return $db_connect->execUpdate($this->table, $this->id, $col, $value);
    }

    public function delete($id) {
        $db_connect = new Bdd();
        $req = "DELETE FROM `".$this->table."` WHERE `id_".$this->table."` = '".$id."'";
        $db_connect->execReq($req);
    }

    public function countUsers() {
        $db_connect = new Bdd();
        return $db_connect->execReq("SELECT COUNT(*) as count_table FROM `".$this->table."`");
    }

    // Récupère prénom + nom à partir du usr_login
    public function getFullName($usr_login) {
        $db_connect = new Bdd();
        $requete = "SELECT `firstname`, `lastname` FROM `".$this->table."` WHERE usr_login = '".$usr_login."'";
        $result = $db_connect->execReq($requete);
        return $result[0][0]." ".$result[0][1];
    }

    public function getFullInfo() {
        $db_connect = new Bdd();
        $requete = "SELECT * FROM `".$this->table."`";
        return $db_connect->execReq($requete);
    }

    public function selectAll() {
        $db_connect = new Bdd();
        return $db_connect->execReq("SELECT * FROM `".$this->table."`");
    }

    public function checkIfPwdIsCorrect($usr_login, $pwd) {
        $db_connect = new Bdd();
        $result = $db_connect->execReq('SELECT `pwd` FROM `'.$this->table.'` WHERE `usr_login` = "'.$usr_login.'"');
        if ($result != array() && $result[0][0] == $pwd) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getIdFromUsrLogin($usr_login) {
        $db_connect = new Bdd();
        return $db_connect->execReq('SELECT id_table FROM `'.$this->table.'` WHERE usr_login = "'.$usr_login.'"');
    }

    // Retourne le nombre de usr_login égalant $usr_login en omettant le usr_login actuel du $id_to_exclude renseigné
    public function checkIfUsrLoginExists($id_to_exclude, $usr_login=-1) {
        $db_connect = new Bdd();
        $query_select = 'SELECT COUNT(*) FROM `'.$this->table.'` WHERE usr_login = "'.$usr_login.'"';
        $query_and = ' AND id_'.$this->table.' != "'.$id_to_exclude.'"';
        $query = $query_select.$query_and;
        return $db_connect->execReq($query)[0][0];
    }


}


?>