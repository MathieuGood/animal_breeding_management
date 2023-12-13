<?php
session_start();
unset($_SESSION['open']);
unset($_SESSION['user_name']);
session_destroy();
?>