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

    // get the task  data by task id
    public static function get_data($tid){
        $db = new Db();

        $tasks = $db->query("SELECT * FROM tasks where task_id=:id", array("id"=>$tid));

        return $tasks;

    }
    
    // get the task  data by task id
    public static function get_data_by_two($username, $datetime){
        $db = new Db();

        $tasks = $db->query("SELECT * FROM tasks where username=:un And :d1 BETWEEN DATE(starting_time) AND DATE(ending_time)", array("un"=>$username,"d1"=>$datetime));

        return $tasks;

    }

    public static function delete($id){
        $db = new Db();
        $result = $db->query("delete from tasks where task_id=:id", array("id"=>$id));
        return true;
    }

    public static function add($task_name, $task_description, $task_type, $starting_time, $ending_time) {

        $db = new Db();
        
        $result = $db->query("Insert into tasks (task_name, task_description, task_type, starting_time, ending_time) Values(:name,:des,:ty,:stime,:etime)", array("name"=>$task_name,"des"=>$task_description, "ty"=>$task_type, "stime"=>$starting_time, "etime"=>$ending_time));
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
