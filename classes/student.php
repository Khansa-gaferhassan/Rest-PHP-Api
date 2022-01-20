<?php 
class Student{
public $name;
    public $email;
    public $mobile;
  public $id;
    private $conn;
    private $table_name;
    
    public function __construct($db){
       // $db =new Database();
        $this->conn=$db;
        $this->table_name= "student";
    }
public function create_data(){
        $query = "INSERT INTO $this->table_name (name, email, mobile) VALUES (?,?,?)";
   // $query= "INSERT INTO ".$this->table_name."  SET name=?, email=?,mobile=?";
    $obj= $this->conn->prepare($query);
        $this->name = htmlspecialchars(strip_tags($this->name));
$this->email=htmlspecialchars(strip_tags($this->email));

        $this->mobile = htmlspecialchars(strip_tags($this->mobile));
        $obj->bind_param("sss", $this->name, $this->email, $this->mobile);
    
if($obj->execute()){
return true;
}
return false;
}

public function get_all_data(){
    $query= "SELECT * from ".$this->table_name;
   $obj= $this->conn->prepare($query);
    $obj->execute();
    return $obj->get_result();
    
}

 
public function get_single_student(){
    
$query ="SELECT * from ".$this->table_name." WHERE id=?";
$obj = $this->conn->prepare($query);
$obj->bind_param("i",$this->id);
$obj->execute();

$data =$obj->get_result();
return $data->fetch_assoc();
    
}
 public function update(){

    $query= "UPDATE $this->table_name(name,email,mobile) VALUES(?,?,?) WHERE id=?";
$obj = $this->conn->prepare($query);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $obj->bind_param("sssi",$this->name,$this->email,$this->mobile,$this->id);


if($obj->execute()){

    return true;
}
return false;
    
 }
 public function delete_student(){

    $query= "DELETE from".$this->table_name."WHERE id=?";
    $obj= $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));

        $obj->bind_param("i", $this->id);

        if ($obj->execute()) {

            return true;
        }
        return false;
    }
    
 
































}




?>