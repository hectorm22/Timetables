<?php 
    if (session_status() == PHP_SESSION_NONE)
        session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>TimeTables</title>
</head>
<body>

<nav class="navbar navbar-expand bg-dark" >
    <div id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <h3 class="text-warning mr-3">TimeTables</h3>
            </li>

            <?php
                if (isset($_SESSION["loggedIn"]))
                {
                    echo '
                    <li class="nav-item">
                        <a class="nav-link text-white" href="logout.php">Log out</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-warning">Logged-in as: '. $_SESSION["loginName"] .'</span></a>
                    </li>';
                }
            ?>
        </ul>
    </div>
</nav>

