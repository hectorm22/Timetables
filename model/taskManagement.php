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

    // get the summary for the report
    public static function get_summary($name,$currentTime,$startTime){
        $db = new Db();

        $r1 =$db->query("SELECT count(*) as total FROM tasks where username=:un AND (starting_time Between :st and :et OR ending_time Between :st and :et) order by task_id",array("un"=>$name, "st"=>$startTime,"et"=>$currentTime));

        $r2 =$db->query("SELECT count(*) as done FROM tasks WHERE status=1 And username=:un AND (starting_time Between :st and :et OR ending_time Between :st and :et) order by task_id",array("un"=>$name, "st"=>$startTime,"et"=>$currentTime));

        $r3 =$db->query("SELECT count(*) as progress FROM tasks WHERE status=0 And username=:un AND (starting_time Between :st and :et OR ending_time Between :st and :et) order by task_id",array("un"=>$name, "st"=>$startTime,"et"=>$currentTime));

        $r4 =$db->query("SELECT count(*) as progType0 FROM tasks WHERE status=0 and task_type=0 And username=:un AND (starting_time Between :st and :et OR ending_time Between :st and :et) order by task_type",array("un"=>$name, "st"=>$startTime,"et"=>$currentTime));

        $r5 =$db->query("SELECT count(*) as progType1 FROM tasks WHERE status=0 and task_type=1 And username=:un AND (starting_time Between :st and :et OR ending_time Between :st and :et) order by task_id",array("un"=>$name, "st"=>$startTime,"et"=>$currentTime));

        // Combine both arrays into a single array
        // Key('total','done')
        // Combine both arrays into a single array
        $data = array_merge($r1, $r2, $r3, $r4, $r5);

        return $data;

    }

    public static function delete($id){
        $db = new Db();
        $result = $db->query("delete from tasks where task_id=:id", array("id"=>$id));
        return true;
    }

    // update status by username and id
    public static function update_status($username, $tid){
        $db = new Db();

        $ret = $db->query("UPDATE tasks SET status=1 WHERE username=:un and task_id=:tid",array("un"=>$username, "tid"=>$tid));

    }

    // update status by username and id
    public static function update_form($task_name, $task_description, $task_type, $starting_time, $ending_time, $username, $tid){
        $db = new Db();
    
        $ret = $db->query("UPDATE tasks SET task_name=:tn,task_description=:td, task_type=:tt, starting_time=:st, ending_time=:et WHERE username=:un and task_id=:tid",array("tn"=>$task_name,"td"=>$task_description,"tt"=>$task_type,"st"=>$starting_time,"et"=>$ending_time,"un"=>$username, "tid"=>$tid));
    
    }

    // new task
    public static function add($task_name, $task_description, $task_type, $starting_time, $ending_time, $username) {

        $db = new Db();
        
        $result = $db->query("Insert into tasks (task_name, task_description, task_type, starting_time, ending_time, username) Values(:name,:des,:ty,:stime,:etime,:un)", array("name"=>$task_name,"des"=>$task_description, "ty"=>$task_type, "stime"=>$starting_time, "etime"=>$ending_time, "un"=>$username));
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
