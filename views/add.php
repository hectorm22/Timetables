<?php include_once("header.php"); ?>

<script>sessionStorage.clear()</script>
<article>
    <!-- Form for submit -->
    <h3>New User</h3>
    <form id="add-form">
        <h6>New Username: </h6>
        <input type="text" placeHolder="Enter username" id="username" name="username" required/>
        <br>
        <br>
        <h6>New Password: </h6>
        <input type="password" placeholder="password" id="userPIN" name='password' required/></br></br>
        <input class="btn" id="add-submit" type="submit" name="login_submit" value="Submit" />
        <button class="btn" onclick="document.location.href = '../index.php'" >Cancel</button>
    </form>
</article>
<script>
    function submit()
    {
        event.preventDefault();

        let formData = Object.fromEntries(new FormData(document.getElementById("add-form")).entries());

        for (const key in formData) {
            if (formData[key].length == 0) {
                alert(`Missing field: ${key} `)
                return;
            }
        }
        
        $.ajax({
            type: "post",
            url: `../index.php?controller=userManagement&action=add&username=${formData.username}&password=${formData.password}`,
            success: function(response) {
                document.location.href="login.php?success=1";
            },
            error: function(xhr, status, error) {
                console.error("Error in AJAX request:", xhr.responseText);
            }
        });
    }

    $("#add-submit").click(submit);
</script>

<?php include_once("footer.php"); ?>