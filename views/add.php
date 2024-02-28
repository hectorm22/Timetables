<!-- a simple view returning json data -->
<?php

include "header.php";
echo "<h3 style=\"text-align: center;\">User added</h3>";

// Check if the session variable is set
if (isset($_SESSION['addUserData'])) {
    $userData = $_SESSION['addUserData'];
    echo "username: " .$userData['username']. "<br>";
    echo "password: " .$userData['password']. "<br>";
    //$jsonData = json_encode($userData, true);

    //displayJsonAsTable($jsonData);
    //echo "Username: " . $userData['username'] . "<br>";
    //echo "Password: " . $userData['password'] . "<br>";

}

include "footer.php";
?>
