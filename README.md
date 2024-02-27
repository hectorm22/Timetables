# timetables


# ServerSide Framework
<hr>

***This is a simple serverside framework in PHP that implements all the basic features of web programming..***

The framework will use [controller] and [action] to operator the web routes. When controller and action are NULL, <br>
the route will guide to the default site. Only [controller] and [action] meet the definition of the router, and   <br>
the requests will be operated by the server side.

Goal: improve the work efficience. When the group defines the data format, it will be convient to cooperate with each <br>
other 

# Define Objects Right Now

- DB class: simplify the sqlite operation (https://github.com/DiseaseNO/PDO-SQLite-Class)
- userManagement class: receive the API operations of userManagement
- user_model class: the functions of the CRUD of user management  
- taskManagement class: receive the API operations of taskManagement
- task_model class: the function of the CRUD of task management

# Functions and API

## API

- default: '/', it redirects the views/index.php
- all: "../index.php?controller=userManagement&action=all". It will get all users by JSON format.
- showAll: "../index.php?controller=userManagement&action=showAll". Return all users by JSON format to AJAX
- add: "../index.php?controller=userManagement&action=add". Post data to API and insert them into databae
- showPassword: "../index.php?controller=userManagement&action=showPassword". Get username and return password to AJAX
- delete: "../index.php?controller=userManagement&action=delete". Get userid and execute delete operation by AJAX 

## Functions

- displayJsonAsTable: help to test data
- function all(): query user data
- function get_password():
- function delete($id):
- function add($name, $password):

## Client Test
- Using Js to get data and print data
- Using AJAX to get data and print data
- using AJAX to post data and excute the statement
- Using html to poset data
