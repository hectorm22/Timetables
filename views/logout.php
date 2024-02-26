<?php

// date_default_timezone_set('America/Los_Angeles');
// error_reporting(E_ALL);
// ini_set("log_errors", 1);
// ini_set("display_errors", 1);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

session_unset();
session_destroy();
header("Location: login.php");

