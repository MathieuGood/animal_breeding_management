let login_logout_link = document.getElementById("login_logout");
// When user clicks on the login/logout button
login_logout_link.addEventListener("click", function () {
    // If the content of document.getElementById("login_logout") is 'Logout'
    if (login_logout_link.innerHTML == 'Logout') {
        // Call components/destroy_session.php to destroy the session
        $.ajax({
            type: "POST",
            url: "components/destroy_session.php",
            // If the ajax query returns a success, refresh the page to reload the menu
            success: function () {
                // location.reload(true);
                login_logout_link.innerHTML == 'Login';
                console.log("login");
            }
        });
    }
});