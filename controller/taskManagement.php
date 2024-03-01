<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");



class taskManagement{
    
    //return all the users
    function all(){
        //use the model to get all the comments from the database
        $users=task_model::all();
        
        // Usage
        $json_users = json_encode($users, true);
        // displayJsonAsTable($users);

        // First PHP file
        $_SESSION['userData'] = $json_users;
    
        //require_once("views/showUsers.php");
        header("Location: views/showUsers.php");
    }

    //AJAX
    function showAll(){
        try{
            $tasks=task_model::all();
        
            header('Content-Type: application/json');
            echo json_encode($tasks);
        
        } catch (Exception $e) {
            http_response_code(500); // Internal Server Error
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    //AJAX
    function showSummary(){
        if (isset($_GET['username'])){
            $name = htmlspecialchars($_GET['username']);

        }else{
            $name = 'demo';
        }
            // Get the current time
            $currentTimestamp = time();  // Current timestamp

            // Get the timestamp for 30 days ago
            $startTimestamp = strtotime('-30 days', $currentTimestamp);

            // Convert timestamps to date strings
            $currentTime = date('Y-m-d H:i:s', $currentTimestamp);
            $startTime = date('Y-m-d H:i:s', $startTimestamp);

        try{
            $tasks=task_model::get_summary($name,$currentTime,$startTime);
            header('Content-Type: application/json');
            echo json_encode($tasks, JSON_PRETTY_PRINT);
        
        } catch (Exception $e) {
            http_response_code(500); // Internal Server Error
            echo json_encode(['error' => $e->getMessage()]);
        }
        
    }

        //AJAX
        function showDataByTwo(){

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
                echo 'test';
                http_response_code(500); // Internal Server Error
                echo json_encode(['error' => $e->getMessage()]);
            }
        }

    //Get Password By inputting username
    function showData(){
        
        // Retrieve the username from the query parameters
        if (isset($_GET['task_id'])){
            $tid = htmlspecialchars($_GET['task_id']);
        

        try{
            $taskData=task_model::get_data($tid);
        
            header('Content-Type: application/json');
            echo json_encode($taskData);
  
            } 
        catch (Exception $e) {
                http_response_code(500); // Internal Server Error
                echo json_encode(['error' => $e->getMessage()]);
            }
        }
    }



    //delete a user
    function delete(){
        //read the id passed over query string
        if(isset($_POST["id"])){
            $id=htmlspecialchars($_POST["id"]);

            //execute the delete command on the model
            $ret=task_model::delete($id);
            echo $ret;
        }
        else{
            echo "null";
        }
            

        
        //require_once("view/deleteUser.php");
    }

    // update the task status by username and id
    function updateStatus(){
        // Get the raw JSON data from the request body
        if ($_SERVER["REQUEST_METHOD"] === "POST"){
            // Retrieve raw POST data
            $rawData = file_get_contents("php://input");

            // Decode JSON data
            $jsonData = json_decode($rawData, true);

            if ($jsonData !== null) {
                //check username
                if (isset($jsonData['username']) && $jsonData['username'] != null){
                    $username = $jsonData['username'];
                }
                else{
                    $username = 'demo';
                }

                //check task id
                //check username
                if (isset($jsonData['task_id']) && $jsonData['task_id'] != null){
                    $tid = $jsonData['task_id'];
                }
                else{
                    $tid = '267';
                }

                try{
                    $ret=task_model::update_status($username, $tid);
                
                    echo 'update successful';
                    } 
                catch (Exception $e) {
                        http_response_code(500); // Internal Server Error
                        echo json_encode(['error' => $e->getMessage()]);
                    }
                }else{
                    echo 'No values submit';
                }
            }else{
                echo 'no post method';
            }
    }

    // update form by username and task id
    function updateForm(){
        // Get the raw JSON data from the request body
        if ($_SERVER["REQUEST_METHOD"] === "POST"){
            // Retrieve raw POST data
            $rawData = file_get_contents("php://input");

            // Decode JSON data
            $jsonData = json_decode($rawData, true);

            if ($jsonData !== null) {
                // Access the data using keys
                $task_name = $jsonData['task_name'];
                $task_description = $jsonData['task_description'];
                $task_type = $jsonData["task_type"];    
                $starting_time = $jsonData["starting_time"]; 
                $ending_time = $jsonData["ending_time"];

                //check username
                if (isset($jsonData['username']) && $jsonData['username'] != null){
                    $username = $jsonData['username'];
                }
                else{
                    $username = 'demo';
                }

                //check task id
                //check username
                if (isset($jsonData['task_id']) && $jsonData['task_id'] != null){
                    $tid = $jsonData['task_id'];
                }
                else{
                    $tid = '267';
                }

                try{
                    $ret=task_model::update_form($task_name, $task_description, $task_type, $starting_time, $ending_time, $username, $tid);
                
                    echo 'update successful';
                    } 
                catch (Exception $e) {
                        http_response_code(500); // Internal Server Error
                        echo json_encode(['error' => $e->getMessage()]);
                    }
                }else{
                    echo 'No values submit';
                }
            }else{
                echo 'no post method';
            }

    }



//**********************************************
//   Check Post
//*********************************************
    //add a task
    function add(){
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
                // Handle decoding error
                echo "Error decoding JSON data.";
            }

        //     if(isset($_POST["task_name"]) && isset($_POST["task_description"])&& 
        //        isset($_POST["task_type"]) && isset($_POST["starting_time"]) &&
        //        isset($_POST["ending_time"])
        //     ) {
        //         $task_name = htmlspecialchars($_POST["task_name"]);    
        //         $task_description = htmlspecialchars($_POST["task_description"]); 
        //         $task_type = htmlspecialchars($_POST["task_type"]);    
        //         $starting_time = htmlspecialchars($_POST["starting_time"]); 
        //         $ending_time = htmlspecialchars($_POST["ending_time"]); 
                
        $ret = task_model::add($task_name, $task_description, $task_type, $starting_time, $ending_time, $username);                
        //         echo $ret;


        //     }else{

        //         echo 'add error';
        //    }
        // }
        }else{
            echo 'test';
        //require_once("views/add.php");
        }
    }

//****************************Function End*************************    
}
?>
