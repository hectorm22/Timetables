<?php
require_once("../functions/displayJSON.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the session variable is set
if (isset($_SESSION['userData'])) {
    $userData = $_SESSION['userData'];

    // Usage
    displayJsonAsTable($userData);
}
