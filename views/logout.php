<?php
session_start();

unset($_SESSION['loggedIn']);
unset($_SESSION['loginName']);

session_unset();
session_destroy();

header("Location: login.php");