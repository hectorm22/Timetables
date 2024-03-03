<?php 
    include_once("header.php"); 

    if (isset($_SESSION["loggedIn"]))
    {
        header("Location: index.php");
        die();
    }
?>
<script>sessionStorage.clear()</script>
<article>
    <!-- Form for submit -->
    <form id="myForm" action="../index.php?controller=userManagement&action=checkLogin" method="post">
        <?php
            if (isset($_GET["failure"]))
                echo '<div class="alert alert-warning" role="alert">Wrong username and/or password.</div>';
            elseif (isset($_GET["success"]))
                echo '<div class="alert alert-success" role="alert">Created a new user.</div>';
        ?>
        <h4>Username: </h4>
        <input type="text" placeHolder="Enter username" id="username" name="username" required/>

        <h4>Password: </h4>
        <input type="password" placeholder="password" id="userPIN" name='userPIN' required/></br></br>
        <input class="btn" type="submit" name="login_submit" value="Sign In" />
        <button class="btn" onclick="document.location.href = 'add.php'" >New User</button>
    </form>
</article>

<?php include_once("footer.php"); ?>
