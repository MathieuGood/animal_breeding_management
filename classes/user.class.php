<?php

// User class for user login
class User
{

    private $table = "user";
    private $id = "";

    public function __construct($my_id = "nothing")
    {
        if ($my_id != "nothing" and $my_id != "new_entry")
            $this->id = $my_id;

    }

    // Check validity of entered username and password
    public function checkIfPwdIsCorrect($usr_name, $pwd)
    {
        $db_connect = new dbConnect();
        $result = $db_connect->sendQuery('SELECT `user_password` FROM `' . $this->table . '` WHERE `user_login` = "' . $usr_name . '"');
        if ($result != array() && $result[0]['user_password'] == $pwd) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

?>