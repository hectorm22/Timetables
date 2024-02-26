<?php 
include "header.php"
?>

<article>
<!-- Form for submit -->
</br></br>
<form id="myForm" action="https://cs.csub.edu/~flin/3350/lab05/index.php?controller=userManagement&action=checkLogin" method="post">
<h4>UserName: </h4>
<input type="text" placeHolder="Enter username" id="username" name="username" required/>
<h4>Password: </h4>
<input type="password" placeholder="password" id="userPIN" name='userPIN' required/></br></br>
<input type="submit" name="login_submit" value="submit" />
</form>
<div>                
Don't have an account?<a href="signup.php">Signup</a>
</div>

<div id="result">Test Data</div>

</article>
</section>

<script>

    // $(document).ready(function(){
    // $("#myForm").submit(function(e) {
    //     var urlAPI = "https://cs.csub.edu/~flin/3350/lab05/index.php?controller=userManagement&action=checkLogin";

    //     $.ajax({
    //         type: "POST",
    //         url: urlAPI,
    //         data: $("#myForm").serialize(),
    //         success: function(data) {
    //             console.log("Response from the server:", data);
    //            // alert("Response from the server:\n" + JSON.stringify(data));
    //            // Redirect to the specified page
    //            // window.location.href = "#";
    //             // Handle the data received from the server
    //             document.getElementById('result').innerHTML = JSON.stringify(data, null, 2);
    //         },
    //         error: function(xhr, status, error) {
    //             console.error("Error in AJAX request:", error);
    //             alert("Error in AJAX request:\n" + error);
    //         },
    //         complete: function() {
    //             console.log("AJAX request completed.");
    //         }
    //     });
    //     showProducts();

    //     e.preventDefault();
    // });
    // });


</script>

<!-- Search permit -->


<?php

// if (isset($_POST["login_submit"])) {
//   unset($_POST["login_submit"]);
//   $username = htmlspecialchars($_POST["username"]);
//   $password = htmlspecialchars($_POST["userPIN"]);

//   $validateStmt = NULL;
//   $validateStmt = $db->prepare("SELECT * FROM operator WHERE username=:userName");
//   $validateStmt->bindValue(":userName", $username, SQLITE3_TEXT);
//   $resUser=$validateStmt->execute();
//   $row_USER = [];
//   $row_USER = $resUser->fetchArray(SQLITE3_ASSOC);
//   $storedHashedPassword = $row_USER['password'];

//   // Validate password entered by user
//   if (password_verify($password, $storedHashedPassword)) {
//     // Password is valid
//     $_SESSION["username"] = $username;
//     header("Location: operator.php");
//   } else {
//     // Password is invalid
//     echo "Login again";
//   }
// }


?>

<?php include "footer.php" ?>

