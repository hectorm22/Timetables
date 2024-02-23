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
<section>
<nav>
    <ul>
      <li><a href="login.php">Login With Your Username</a></li></br>

    </ul>
</nav>

<article>
<!-- Form for submit -->
</br></br>
<form action="login.php" method="post">
<h4>UserName: </h4>
<input type="text" placeHolder="Enter username" name="username" required/>
<h4>Password: </h4>
<input type="password" placeholder="password" name='userPIN' required/></br></br>
<input type="submit" name="login_submit" value="submit" />
</form>
<div>                
Don't have an account?<a href="signup.php">Signup</a>
</div>

</article>
</section>
<footer>
<h4> Lab05 on CSMP3350 </h4>
</footer>
</body>

<!-- Search permit -->


<?php

if (isset($_POST["login_submit"])) {
  unset($_POST["login_submit"]);
  $username = htmlspecialchars($_POST["username"]);
  $password = htmlspecialchars($_POST["userPIN"]);

  $validateStmt = NULL;
  $validateStmt = $db->prepare("SELECT * FROM operator WHERE username=:userName");
  $validateStmt->bindValue(":userName", $username, SQLITE3_TEXT);
  $resUser=$validateStmt->execute();
  $row_USER = [];
  $row_USER = $resUser->fetchArray(SQLITE3_ASSOC);
  $storedHashedPassword = $row_USER['password'];

  // Validate password entered by user
  if (password_verify($password, $storedHashedPassword)) {
    // Password is valid
    $_SESSION["username"] = $username;
    header("Location: operator.php");
  } else {
    // Password is invalid
    echo "Login again";
  }


}

