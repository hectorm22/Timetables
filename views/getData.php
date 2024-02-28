<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>AJAX Example</title>
</head>
<body>

<div id="result">Data will be displayed here.</div>

<script>

// Function to fetch data from the PHP server
function fetchData() {
    fetch('https://cs.csub.edu/~flin/3350/lab05/index.php?controller=userManagement&action=showAll')

        .then(response => {
           if (!response.ok) {
              throw new Error(`HTTP error! Status: ${response.status}`);
           }
            return response.json();
         })
         .then(data => {
             displayData(data);
          })
         .catch(error => {
             console.error('Error fetching data:', error);
             if (error && error.response && error.response.text) {
                 console.error('Response text:', error.response.text());
             }
         });

}

// Function to display data in the "result" div
function displayData(responseData) {
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

// Call the function to fetch data when the page loads
fetchData();


</script>

</body>
</html>

