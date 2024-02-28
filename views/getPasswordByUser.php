<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>AJAX Example</title>
</head>
<body>

    <form id="userDataForm">
        <label for="username">Enter Username:</label>
        <input type="text" id="username" name="username" required>
        <button type="button" id="getDataButton">Get Password</button>
    </form>

    <div id="result"></div>

<script>

document.addEventListener('DOMContentLoaded', function () {
    // Attach a click event listener to the button
    document.getElementById('getDataButton').addEventListener('click', function () {
        // Get the username from the input field
        const username = document.getElementById('username').value;

        // Make an AJAX request
        fetch(`https://cs.csub.edu/~flin/3350/lab05/index.php?controller=userManagement&action=showPassword&username=${username}`)
            .then(response => {
                if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.text();
            })
            .then(data => {
                // console data log
                console.log(data);

                // Handle the data received from the server
                document.getElementById('result').innerHTML = JSON.stringify(data, null, 2);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                if (error && error.response && error.response.text) {
                    console.error('Response text:', error.response.text());
                }

            });
    });
});

// Function to display data in the "result" div
function displayData(responseData,user) {
    // Get the div element by its ID
    const resultDiv = document.getElementById('result');
    
    // Create a string to hold the HTML content
    let htmlContent = '<ul>';

    // Iterate through the data and create list items
    responseData.forEach(user => {
        htmlContent += `<li>User ID: ${user.user_id}, Username: ${user.username}</li>`;
    });

    htmlContent += '</ul>';

    // Set the HTML content of the div
    resultDiv.innerHTML = htmlContent;
}



</script>
</body>
</html>

