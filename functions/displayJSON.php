<?php
function displayJsonAsTable($jsonData) {

    // Decode JSON data
    $data = json_decode($jsonData, true);

    // Check if decoding was successful
    if ($data === null) {
        die('Error decoding JSON file.');
    }

    // Get the columns (keys) from the first item in the array
    $columns = array_keys($data[0]);

    // Output columns as headers
    echo '<table border="1">';
    echo '<tr>';
    foreach ($columns as $column) {
        echo '<th>' . htmlspecialchars($column) . '</th>';
    }
    echo '</tr>';

    // Loop through data and output table rows
    foreach ($data as $item) {
        echo '<tr>';
        foreach ($columns as $column) {
            echo '<td>' . htmlspecialchars($item[$column]) . '</td>';
        }
        echo '</tr>';
    }

    echo '</table>';
}
