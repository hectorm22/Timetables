<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    </head>
    <body>


        <div class="container">
            <h3>Task Form</h3>
            <form id="task-form">
                <div class="form-group bg-light">
                    <label for="username">User Name</label>
                    <input id="username" class="form-control" type="text" name="username">
                </div>
                <div class="form-group bg-light">
                    <label for="datetime">Date</label>
                    <input id="datetime" class="form-control" type="date" name="datetime">
                </div>
                <br>

                <button id="getDataButton" class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>

        <div id="result">Test Data</div>
    </body>

    <script>

document.addEventListener('DOMContentLoaded', function () {
    // Attach a click event listener to the button
    document.getElementById('getDataButton').addEventListener('click', function () {
        // Get the username from the input field
        const username = document.getElementById('username').value;
        const datetime = document.getElementById('datetime').value;

        // Make an AJAX request
        fetch(`https://cs.csub.edu/~flin/3350/lab05/index.php?controller=taskManagement&action=showDataByTwo&username=${username}&datetime=${datetime}`)
            .then(response => {
                if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                // console data log
                console.log(data);

                // Handle the data received from the server
                displayData(data);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                if (error && error.response && error.response.json) {
                    console.error('Response Json:', error.response.json());
                }

            });
    });
});

// Function to display data in the "result" div
function displayData(responseData) {
    const resultDiv = document.getElementById('result');

    // Check if responseData is an array
    if (Array.isArray(responseData)) {
        let htmlContent = '<ul>';

        // Iterate through the array and create list items
        responseData.forEach(tasks => {
            htmlContent += `<li>Task ID: ${tasks.task_id}, Task Name: ${tasks.task_name},
                            Task Type: ${tasks.task_type}, Starting Time: ${tasks.starting_time}, Ending Time: ${tasks.ending_time}
                        </li>`;
        });

        htmlContent += '</ul>';

        // Set the HTML content of the div
        resultDiv.innerHTML = htmlContent;
    } else {
        // Handle the case where responseData is not an array
        resultDiv.innerHTML = 'Invalid data format';
        console.error('Invalid data format:', responseData);
    }
}



</script>

<?php include "footer.php"?>