<?php
date_default_timezone_set('America/Los_Angeles');

// read and write access on the 'other' group must be enabled on the full path of errors.txt.
error_reporting(E_ALL);
ini_set("error_log", "errors.txt");
ini_set("log_errors", 1);
ini_set("display_errors", 1);    
ini_set('session.cookie_httponly', 1);

require_once("dbClass.php");

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
