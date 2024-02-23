<?php
require_once("./functions/displayJSON.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$jsonData = $_SESSION['jsonData'];

// Usage
displayJsonAsTable($jsonData);

