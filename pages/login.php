<?php

$user_db = new User();


if (isset($_POST["form_submit"])) {
    $id = $_POST["user_name"];
    $pwd = $_POST["password"];
    // If user_name and password match a database entry, update SESSION to be open
    if ($user_db->checkIfPwdIsCorrect($id, $pwd)) {

        $_SESSION['open'] = 1;
        $_SESSION['user_name'] = $_POST["user_name"];

        header("Location: index.php?page=animal_list");
    } else {

        echo "Username or password not valid.<br /><br />";

    }
}
// If the user logs out, destroy session
if (isset($_POST['logout'])) {
    $_SESSION['open'] = 0;
    unset($_SESSION['open']);
    unset($_SESSION['user_name']);
    session_destroy();

    echo "<meta http-equiv='refresh' content='0'>";
}

// If id_login is '' or < 1, display the login form
if (!isset($_SESSION['open']) || $_SESSION['open'] < 1) {
    ?>
    <div class="container">
        <h3>User login</h3>

        <div class="col-auto">


            <form method="POST" action="">

                <table class="formtable">

                    <tr>
                        <td>User name</td>
                        <td><input type="text" class="form-control" name="user_name" value=""></td>
                    </tr>

                    <tr>
                        <td>Password</td>
                        <td><input type="password" class="form-control" name="password" value=""></td>
                    </tr>

                </table>

                <div class="pt-3">
                    <input class="btn btn-primary" type="submit" name="form_submit" value="Submit">
                </div>

            </form>


        </div>

    </div>


    <?php
} else {
    header("Location: index.php?page=animal_list");
    ?>

    <form method="POST" action="">
        <input class="button" type="submit" name="logout" value="Logout">
    </form>
<?php } ?>