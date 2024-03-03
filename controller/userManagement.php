<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

class userManagement{
    function home()
    {
        header("Location: views/login.php");
        die();
    }
    
    //Check Login
    function checkLogin()
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();

        // Retrieve the username from the query parameters
        if ($_SERVER["REQUEST_METHOD"] === "POST"){
            if(isset($_POST["username"]) && isset($_POST["userPIN"]) ) {
                $username = htmlspecialchars($_POST["username"]);
                $password = htmlspecialchars($_POST["userPIN"]);
                
                try{
                    $pw=user_model::get_password($username);
                    
                    if (!$pw)
                    {
                        // credential failure
                        header("Location: views/login.php?failure=1");
                        die();
                    }

                    $stored_password = $pw[0]['password'];

                    // Validate password entered by user
                    if (password_verify($password, $stored_password)) {
                        // Password is valid, set up session variables.
                        $_SESSION["loggedIn"] = true;
                        $_SESSION["loginName"] = $username;

                        header("Location: views/index.php");
                        die();
                    } 
                    else {
                        // Password is invalid
                        header("Location: views/login.php?failure=1");
                        die();
                    } 
                }
                catch (Exception $e) {
                    http_response_code(500); // Internal Server Error
                    echo json_encode(['error' => $e->getMessage()]);
                }
            }
            else{
                echo 'null';
            }
        }
        else{
            echo "error";
        }
    }

    //Get Password By inputting username
    function showPassword(){
        
        // Retrieve the username from the query parameters
        if (isset($_GET['username'])){
            $username = $_GET['username'];
        }
        echo $username;

        try{
            $pw=user_model::get_password($username);
        
            header('Content-Type: application/json');
            echo json_encode($pw);
  
            } 
        catch (Exception $e) {
                http_response_code(500); // Internal Server Error
                echo json_encode(['error' => $e->getMessage()]);
            }
    }

    //delete a user
    function delete(){
        //read the id passed over query string
        if(isset($_POST["id"])){
            $id=htmlspecialchars($_POST["id"]);

            //execute the delete command on the model
            $ret=user_model::delete($id);
            echo $ret;
        }
        else{
            echo "null";
        }
    }

//**********************************************
//   Check Post
//*********************************************
    //add a user
    function add(){
        // Get the raw JSON data from the request body
        if ($_SERVER["REQUEST_METHOD"] === "POST")
        {
            if(isset($_GET["username"]) && isset($_GET["password"]) )
            {
                $name = htmlspecialchars($_GET["username"]);
                $pw = htmlspecialchars($_GET["password"]);    
                $hassed_pass = password_hash($pw, PASSWORD_DEFAULT); 
                
                user_model::add($name, $hassed_pass);
            }
            else
            {
                http_response_code(500); // Internal Server Error
                echo json_encode(['error' => "username and/or password fields must be present."]);
            }
        }
    }

//****************************Function End*************************    
}
?>
