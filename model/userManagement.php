<?php

//a class for dealing with a object comment saving, reading and deleting it from the database
class user_model{
    public $id;
    public $name;

    public function __construct($name,$id) {
        $this->id = $id;
        $this->name = $name;
    }

    public static function get($product_id){
        $list = [];
        $db = Db::getInstance();
        if($result = mysqli_query($db,"SELECT * FROM product where id = $product_id")) {
            if($row = mysqli_fetch_assoc($result)){
                $list = new product_model($row['name'],$row['id']);
            }
        }



        return $list;
    }


    public static function all(){
    //list of all users
        $db = new DB();

        $persons = $db->query("SELECT * FROM user");

        // Convert array to JSON
        $jsonData = json_encode($persons, true);


        return $jsonData;
    }


    public static function delete($id){
        $db = Db::getInstance();
        $result = mysqli_query($db,"delete from product where id='$id'");
        require_once("model/comment.php");
        $result2 = mysqli_query($db,"delete from comment where product_id='$id'");
        return true;
    }

    public static function add($name) {

        $db = Db::getInstance();
        $result = mysqli_query($db,"Insert into product (name) Values ('$name')");
        $id=mysqli_insert_id($db);
        return new product_model($name,$id);
    }
}
?>
