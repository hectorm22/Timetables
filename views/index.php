<?php include "header.php"?>

<div>
<form id="myForm">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">password:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit" value="Submit" id = "jsonTest">Insert</button>
</form>
<br>
<br>

<form action="https://cs.csub.edu/~flin/3350/lab05/index.php?controller=userManagement&action=delete" method="post">
    <label for="id">User ID:</label>
    <input type="text" id="id" name="id" required>
    <button type="submit" value="delete">delete</button>
</form>

<!-- Your HTML form or any trigger element -->
<button id="getDataButton">Get Data</button>

<div id="result"></div>

</div>

<script>

    $(document).ready(function(){
    $("#myForm").submit(function(e) {
        var urlAPI = "https://cs.csub.edu/~flin/3350/lab05/index.php?controller=userManagement&action=add";

        $.ajax({
            type: "POST",
            url: urlAPI,
            data: $("#myForm").serialize(),
            success: function(data) {
                console.log("Response from the server:", data);
               // alert("Response from the server:\n" + JSON.stringify(data));
               // Redirect to the specified page
               // window.location.href = "#";
            },
            error: function(xhr, status, error) {
                console.error("Error in AJAX request:", error);
                alert("Error in AJAX request:\n" + error);
            },
            complete: function() {
                console.log("AJAX request completed.");
            }
        });
        showProducts();

        e.preventDefault();
    });
    });


    $(document).ready(function() {
    $("#getDataButton").click(function() {
        // AJAX request
        $.ajax({
            type: "GET", // or "POST" depending on your server-side logic
            url: "https://cs.csub.edu/~flin/3350/lab05/index.php?controller=userManagement&action=showAll", // Replace with the actual path to your PHP script
            dataType: "json", // Expecting JSON response, adjust based on your needs
            success: function(data) {
                console.log("Data received from the server:", data);

                // Process and use the data as needed
                // For example, update the DOM with the received data
                $("#result").html("Received data: " + data);
            },
            error: function(xhr, status, error) {
                console.error("Error in AJAX request:", error);
            }
        });
    });
    });


    function showProducts() {
        $.get("https://cs.csub.edu/~flin/3350/lab05/index.php?controller=userManagement&action=showAll", function (data) {
            $("#result").html(data);
        });
    }

    function deleteProductAJAX($event) {
        $.ajax({
                url: $event,
                success: function(response) {
                    //alert(response);
                }
            });
        event.preventDefault();
        showProducts();
    }
    
</script>

<?php include "footer.php"?>
