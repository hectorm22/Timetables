<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


class userManagement{
    
    function home(){

        //header("views/logout.php");
        require_once("views/login.php");
    }
    
    //Check Login
    function checkLogin(){
        // Retrieve the username from the query parameters
        if ($_SERVER["REQUEST_METHOD"] === "POST"){
        //if (isset($_POST["login_submit"])){
            if(isset($_POST["username"]) && isset($_POST["userPIN"]) ) {
                $username = htmlspecialchars($_POST["username"]);
                $password = htmlspecialchars($_POST["userPIN"]);

                try{
                    $pw=user_model::get_password($username);
                    $stored_password = $pw[0]['password'];

                    // Validate password entered by user
                    if (password_verify($password, $stored_password)) {
                    
                        // Password is valid
                        $_SESSION["loginName"] = $username;
                        header("Location: views/index.php");
                        // header('Content-Type: application/json');
                        // echo json_encode($pw);
                    } 
                    else {
                        // Password is invalid
                        echo "Login again";
          
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
        }else{
            echo "error";
        }


    }


    //return all the users
    function all(){
        //use the model to get all the comments from the database
        $users=user_model::all();
        
        // Usage
        $json_users = json_encode($users, true);
        // displayJsonAsTable($users);

        // First PHP file
        $_SESSION['userData'] = $json_users;
    
        require_once("views/showUsers.php");
        //header("Location: views/showUsers.php");
    }

    //AJAX
    function showAll(){
        try{
            $users=user_model::all();
        
            header('Content-Type: application/json');
            echo json_encode($users);
        
        } catch (Exception $e) {
            http_response_code(500); // Internal Server Error
            echo json_encode(['error' => $e->getMessage()]);
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
            

        
        //require_once("view/deleteUser.php");
    }

//**********************************************
//   Check Post
//*********************************************
    //add a user
    function add(){
        // Get the raw JSON data from the request body
        
        if ($_SERVER["REQUEST_METHOD"] === "POST"){
            if(isset($_POST["username"]) && isset($_POST["password"]) ) {
                $name = htmlspecialchars($_POST["username"]);
                $pw = htmlspecialchars($_POST["password"]);    
                $hassed_pass = password_hash($pw, PASSWORD_DEFAULT); 
                
                $ret = user_model::add($name, $hassed_pass);                
                echo $ret;


            }else{

                echo 'add error';
           }
        }
        else{
            echo 'test';
            require_once("views/add.php");
        }
    }

//****************************Function End*************************    
}
?>
