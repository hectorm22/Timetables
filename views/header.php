<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    //header("Location: login.php");
}
else{
    $loginname=$_SESSION["loginName"];
}

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
    <title>Tasks Builder!</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-blue bg-dark" >
    <div class="collapse navbar-collapse" id="navbarNav"  >
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="../index.php?controller=userManagement&action=all">All Users</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" style="color: red;">Login User: <?php echo $loginname; ?></span></a>
            </li>
        </ul>
    </div>
</nav>

<div class="container " >
    <div class="row">
        <div class="col">
            <h1 style="text-align: center;">Lab05 - Tasks Buider</h1>
        </div>
    </div>
</div>

