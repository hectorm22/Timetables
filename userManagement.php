<?php

//a class for dealing with a object comment saving, reading and deleting it from the database
class user_model{
    public $name;
    public $id;

    public function __construct($name,$id) {
        $this->name = $name;
        $this->id = $id;
    }

    public static function get_password($username){
        $db = new Db();
        //$db->bind("username",$username);

        if($result = $db->query("SELECT * FROM user where username = :username", array("username"=>$username)))
        {
            return $result;
        }
    }


    public static function all(){
    //list of all users
        $db = new Db();

        $persons = $db->query("SELECT * FROM user");


        return $persons;
    }


    public static function delete($id){
        $db = new Db();
        $result = $db->query("delete from user where user_id=:id", array("id"=>$id));
        return true;
    }

    public static function add($name, $password) {

        $db = new Db();
        
        $result = $db->query("Insert into user (username, password) Values(:name,:pass)", array("name"=>$name,"pass"=>$password));
        // Do something with the data 
        if($result > 0 ) {
            return 'Succesfully created a new user !';
        }
        else{
            return 'Error add user !';
        }
    }

//=====================Functions End============================
}
?>
