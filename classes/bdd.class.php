<?php

class Bdd {

    // Paramètres
    private $host;
    private $dbname;
    private $user;
    private $passw;
    private $conn;

    // Constructeur
    public function __construct($h='localhost', $db='phpoo', $u='mariadb', $pw='mariadb*1') {
        $this->conn = new PDO("mysql:host=".$h.";dbname=".$db, $u, $pw);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Execution requête
    public function execReq($req) {
        // Sécurisation de la requête
        // On autorise que les fonctions SQL SELECT, INSERT et UPDATE
        // trim() permet de supprimer tous les espaces perturbateurs notamment au début et à la fin de la chaîne
        $startreq = explode(' ', trim($req));
        if ($startreq[0] == 'SELECT' || $startreq[0] == 'INSERT' || $startreq[0] == 'UPDATE' || $startreq[0] == 'DELETE') {
            // Exécution
            $res = $this->conn->query($req);
            // Traitement du résultat
            // Dans le cas d'un SELECT, on convertit le résulat de la requête en tableau PHP
            if ($startreq[0] == 'SELECT') $res = $res->fetchAll();
            // Dans le cas d'un INSERT, on récupère l'id du nouvel élément créé dans la base
            if ($startreq[0] == 'INSERT') {
                $res = $this->conn->lastInsertId();
                echo "lastInsertId is ".$res."<br />";
            }
            // Renvoi du résultat
            return $res;
        } else {
            return FALSE;
        }
    }

    // Alternative insert function
    public function create($table) {
        $requete = "INSERT INTO `".$table."` (`id_".$table."`) VALUES (NULL)";
        return $this->execReq($requete);
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

        $requete = "INSERT INTO `".$table."` (".$cols_list.") VALUES (".$values_list.")";

        // For debugging
        // echo "<br />INSERT >>>><br />";
        // echo "SQL Query : ".$requete."<br />";

        $resultat = $this->execReq($requete);
        return $resultat[0][0];
    }
    
    // Setter pour UPDATE
    public function execUpdate($table, $id, $col, $value) {
        // Previous version
        // $requete = 'UPDATE `'.$table.'` SET `'.$col.'` = "'.addslashes($value).'" WHERE `id_'.$table.'` = '.$id;
        $requete = "UPDATE `".$table."` SET `".$col."` = '".addslashes($value)."' WHERE `id_".$table."` = ".$id;
        echo $requete;
        // For debugging
        // echo "<br />UPDATE >>>><br />";
        // echo "SQL Query : ".$requete."<br />";
        $this->execReq($requete);
    }

    // Get
    public function select($table, $id, $col) {
        $requete = "SELECT `".$col."` FROM `".$table."` WHERE `id_".$table."` = ".$id;
        $result = $this->execReq($requete);
        return stripslashes($result[0][0]);
    }
}
?>