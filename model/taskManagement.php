<?php

//a class for dealing with a object comment saving, reading and deleting it from the database
class task_model{
    public $name;
    public $id;

    public function __construct($name,$id) {
        $this->name = $name;
        $this->id = $id;
    }

    public static function all(){
    //list of all users
        $db = new Db();

        $tasks = $db->query("SELECT * FROM tasks");


        return $tasks;
    }


    public static function delete($id){
        $db = new Db();
        $result = $db->query("delete from tasks where user_id=:id", array("id"=>$id));
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
