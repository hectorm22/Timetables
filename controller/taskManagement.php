<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// task CRUD operations
class taskManagement
{
    // create a task
    function create(){
        // Get the raw JSON data from the request body
        if ($_SERVER["REQUEST_METHOD"] === "POST"){
            // Retrieve raw POST data
            $rawData = file_get_contents("php://input");

            // Decode JSON data
            $jsonData = json_decode($rawData, true);

            // Check if decoding was successful
            if ($jsonData !== null) {
                // Access the data using keys
                $task_name = $jsonData['task_name'];
                $task_description = $jsonData['task_description'];
                $task_type = $jsonData["task_type"];
                $starting_time = $jsonData["starting_time"];
                $ending_time = $jsonData["ending_time"];
                if (isset($jsonData['username']) && $jsonData['username'] != null){
                    $username = $jsonData['username'];
                }
                else{
                    $username = 'demo';
                }

            } else {
                http_response_code(500); // Internal Server Error
                echo json_encode(['error' => "couldn't decode json data"]);
                die();
            }

            $ret = task_model::add($task_name, $task_description, $task_type, $starting_time, $ending_time, $username);
            echo json_encode(["create:" => "OK"]);
        }
    }

    // get all tasks of the month given
    function readFromMonth()
    {
        if (isset($_GET["month"]))
        {
            $username = $_SESSION["loginName"];
            $month = $_GET["month"];

            try{
                $tasks = task_model::get_data_by_month($username, $month);
                echo json_encode($tasks, JSON_PRETTY_PRINT);
            } 
            catch (Exception $e) {
                http_response_code(500); // Internal Server Error
                echo json_encode(['error' => $e->getMessage()]);
            }
        }
        else
        {
            http_response_code(500); // Internal Server Error
            echo json_encode(['error' => "month field must be present"]);
        }
    }

    function readSummary()
    {
        $username = $_SESSION["loginName"];
        
        // Get the current time
        $currentTimestamp = time();  // Current timestamp

        // Get the timestamp for 30 days ago
        $startTimestamp = strtotime('-30 days', $currentTimestamp);

        // Convert timestamps to date strings
        $currentTime = date('Y-m-d H:i:s', $currentTimestamp);
        $startTime = date('Y-m-d H:i:s', $startTimestamp);

        try{
            $tasks=task_model::get_summary($username, $currentTime, $startTime);
            header('Content-Type: application/json');
            echo json_encode($tasks, JSON_PRETTY_PRINT);

        } 
        catch (Exception $e) {
            http_response_code(500); // Internal Server Error
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    // get all tasks where the date given falls within their starting and ending dates.
    function readIntermediateDate()
    {
        if (isset($_GET['username'])&& isset($_GET['datetime'])){
            $username = htmlspecialchars($_GET['username']);
            $datetime = date(htmlspecialchars($_GET['datetime']));

            try{
                $tasks=task_model::get_data_by_two($username, $datetime);
                header('Content-Type: application/json');
                echo json_encode($tasks, JSON_PRETTY_PRINT);

            } catch (Exception $e) {
                http_response_code(500); // Internal Server Error
                echo json_encode(['error' => $e->getMessage()]);
            }
        }else{
            http_response_code(500); // Internal Server Error
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    // read a task from its id number
    function readFromID()
    {
        if (!isset($_GET["id"]))
        {
            http_response_code(500); // Internal Server Error
            echo "error: task id field must be present.";
            die();
        }

        try
        {
            $tid = htmlspecialchars($_GET['id']);
            $taskData = task_model::get_data($tid)[0];

            header('Content-Type: application/json');
            echo json_encode($taskData);
        }
        catch (Exception $e)
        {
            http_response_code(500); // Internal Server Error
            echo "error: " . $e->getMessage();
        }
    }

    // get a task by a given date
    function readFromDate()
    {
        if (!isset($_GET['username']) || !isset($_GET["date"]))
        {
            http_response_code(500); // Internal Server Error
            echo json_encode(['error' => "date and/or username field must be present"]);
            die();
        }

        try
        {
            $username = htmlspecialchars($_GET['username']);
            $date = htmlspecialchars($_GET['date']);

            $taskData = task_model::get_data_by_date($username, $date);

            header('Content-Type: application/json');
            echo json_encode($taskData);
        }
        catch (Exception $e)
        {
            http_response_code(500); // Internal Server Error
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    // update form by username and task id
    function update(){
        // Get the raw JSON data from the request body
        if ($_SERVER["REQUEST_METHOD"] === "POST")
        {
            // Retrieve raw POST data
            $rawData = file_get_contents("php://input");

            // Decode JSON data
            $jsonData = json_decode($rawData, true);

            if ($jsonData !== null)
            {
                // Access the data using keys
                $task_name = $jsonData['task_name'];
                $task_description = $jsonData['task_description'];
                $task_type = $jsonData["task_type"];
                $starting_time = $jsonData["starting_time"];
                $ending_time = $jsonData["ending_time"];
                $username = $_SESSION["loginName"];
                $tid = $jsonData["task_id"];

                try
                {
                    task_model::update_form($task_name, $task_description, $task_type, $starting_time, $ending_time, $username, $tid);
                    echo json_encode(["update:" => "OK"]);
                }
                catch (Exception $e)
                {
                    http_response_code(500); // Internal Server Error
                    echo json_encode(['error' => $e->getMessage()]);
                }
            }
        }
        else
            echo json_encode(['error' => $e->getMessage()]);
    }

    // update the task status by username and id
    function updateFinish()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST")
        {
            // Retrieve raw POST data
            $rawData = file_get_contents("php://input");

            // Decode JSON data
            $jsonData = json_decode($rawData, true);

            $username = $_SESSION["loginName"];
            $id = $jsonData["task_id"];

            //execute the delete command on the model
            task_model::update_status($username, $id);
            echo json_encode(["finish:" => "OK"]);
        }
        else
        {
            http_response_code(500); // Internal Server Error
            echo json_encode(['error' => "no task id for finish status update"]);
        }
    }

    //delete a task
    function delete(){
        //read the id passed over query string
        if ($_SERVER["REQUEST_METHOD"] === "POST")
        {
            // Retrieve raw POST data
            $rawData = file_get_contents("php://input");

            // Decode JSON data
            $jsonData = json_decode($rawData, true);
            $id = $jsonData["task_id"];
            
            //execute the delete command on the model
            task_model::delete($id);
            echo json_encode(["delete:" => "OK"]);
        }
        else
        {
            http_response_code(500); // Internal Server Error
            echo json_encode(['error' => "no task id"]);
        }
    }
}