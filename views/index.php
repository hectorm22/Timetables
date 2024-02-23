<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form to JSON</title>
</head>
<body>

<form id="myForm">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">password:</label>
    <input type="password" id="password" name="password" required>

    <button type="button" onclick="submitForm()">Submit</button>
</form>

<div id="responseMessage"></div>

<script>

function submitForm() {
    // Get form data
    const formData = new FormData(document.getElementById('myForm'));

    // Convert FormData to JSON
    const jsonData = {};
    formData.forEach((value, key) => {
        jsonData[key] = value;
    });

    // Convert JSON data to a string
    const jsonString = JSON.stringify(jsonData);

    // Send POST request to PHP server
    fetch('../index.php?controller=userManagement&action=add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: jsonString,
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        // Display success message or update UI
        document.getElementById('responseMessage').innerHTML = 'Server response: ' + JSON.stringify(data);
    })
    .catch(error => {
        // Display error message or update UI
        console.error('Error:', error);
        document.getElementById('responseMessage').innerHTML = 'Error: ' + error.message;
    });
}

</script>

</body>
</html>

