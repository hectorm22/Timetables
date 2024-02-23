<?php
require_once("../db/dbClass.php");
require_once("nav.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Lab05 on CMPS3350</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" text="text/css" href="../css/layout.css">
<body>
    <?php
        echo "404, no page found";
?>
</body>
</html>
