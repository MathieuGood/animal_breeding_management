<?php
// Si l'utilisateur se déconnecte, on remet id_login à 0 et on détruit la session
if (isset($_POST['logout'])) {
    $_SESSION['open'] = 0;
    unset($_SESSION['open']);
    unset($_SESSION['user_name']);
    session_destroy();
    // Rafraîchir la page pour recharger le menu et supprimer les liens pour l'accès administrateur
    // echo "<meta http-equiv='refresh' content='0'>";
}
?>

<nav class="navbar navbar-expand-md bg-body-tertiary" id="menu_navbar">
    <div class="container-fluid">
        <span class="navbar-brand">
            <a href="index.php?page=animal_list">
                <img src="images/snake.svg" id="animal_logo" alt="Animal Logo">
            </a>
            Breeding Management
        </span>
        <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php
                if (isset($_SESSION['open']) && $_SESSION['open'] > 0) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link pink_link" aria-current="page" href="index.php?page=animal_list">Animal List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pink_link" href="index.php?page=breed_animals">Breeding</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pink_link" href="index.php?page=animal_history">Animal history</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="">
                            <input class="btn btn-primary" type="submit" name="logout" value="Logout">
                        </form>
                    </li>

                    <?php
                }
                ?>

            </ul>
        </div>
    </div>
</nav>



<script>
    let login_logout_link = document.getElementById("login_logout");
    // When user clicks on the login/logout button
    login_logout_link.addEventListener("click", function () {
        // If the content of document.getElementById("login_logout") is 'Logout'
        if (login_logout_link.innerHTML == 'Logout') {
            // Call ajax_queries/destroy_session.php to destroy the session
            $.ajax({
                type: "POST",
                url: "ajax_queries/destroy_session.php",
                // If the ajax query returns a success, refresh the page to reload the menu
                success: function () {
                    // location.reload(true);
                    login_logout_link.innerHTML == 'Login';
                    console.log("login");
                }
            });
        }
    });



</script>