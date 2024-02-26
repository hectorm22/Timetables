<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("dbClass.php");
//require_once("./views/nav.php");
require_once("./functions/displayJSON.php");

//============================================================
//  Controller: tables   Action: CRUD
//============================================================

//$controller and $action passed over query string
if(isset($_GET["controller"])&&isset($_GET["action"])){
$controller=$_GET["controller"];
$action=$_GET["action"];
}
else
{
//in case the product doesnt give us this values, we set them to a default controller and action
$controller="userManagement";
$action="home";
}

//we load up our routing code, that will execute the action on the controller
require_once("routes.php");












// The instance
//$db = new Db();

//echo '1. Fetch whole table';
//$persons = $db->query("SELECT * FROM user");

// Convert array to JSON
//$jsonData = json_encode($persons, true);

// Usage
//displayJsonAsTable($jsonData);
//============================================================

//echo '2. Read friendly method \n';

// Check if an array is empty
//if (empty($db)) {
//    echo "The array is empty or null.";
//} else {
//    echo "The array is not empty.";
//}
//$db->bind("username","demo");
//$pw   =  $db->query("SELECT * FROM user WHERE username = :username");

// Convert array to JSON
//$jsonData = json_encode($pw, true);

// Usage
//displayJsonAsTable($jsonData);

//=================================================================

//echo '3. Bind more parameters \n';
//$db->bindMore(array("username"=>"demo","id"=>"239"));
//$person   =  $db->query("SELECT password FROM user WHERE username = :username AND user_id = :id");

// Convert array to JSON
//$jsonData = json_encode($person, true);

// Usage
//displayJsonAsTable($jsonData);

