<?php
session_start();

class userManagement{
//three simple actions

//return all the users
    function all(){
        //use the model to get all the comments from the database
        $users=user_model::all();
        
        // Usage
        // displayJsonAsTable($users);

        // First PHP file
        $_SESSION['jsonData'] = $users;
        require_once("views/showUsers.php");
    }

    //AJAX
    function showAll(){
        $users=user_model::all();
        require_once("view/showUsers.php");
    }

//delete a user
    function delete(){
        //read the id passed over query string
        if(isset($_GET["id"]))
            $id=$_GET["id"];
//execute the delete command on the model
        $ret=product_model::delete($id);
//return a simple view of confirming the deletion
        require_once("view/deleteUser.php");
    }


//add a user
    function add(){
    // Get the raw JSON data from the request body
        $inputData = file_get_contents('php://input');
        // Decode the JSON data
        $jsonData = json_decode($inputData, true);
        // Usage
        // displayJsonAsTable($users);

//read the data send over post method
        if(isset($_POST["name"]) ) {
            $name = $_POST["name"];
//add a new comment using the model
            $ret = user_model::add($name);
//return the conformation of succesful insertion
            require_once("view/add.php");
        }
    }
}
?>
