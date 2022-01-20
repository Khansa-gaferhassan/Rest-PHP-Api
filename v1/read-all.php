<?php
ini_set("display_errors",1);

header("Access-Control-Allow-Origin:*");
header("Access-ControlAllow-Methods:GET");

include_once "../config/database.php";
include_once "../classes/student.php";
//$db = new Database();
$connection = $db->connect();
$student = new Student($connection);

if($_SERVER['REQUEST_METHOD']==="GET"){
   $data= $student->get_all_data();

if($data->num_rows>0){
    $student_arr["records"]=array();
    while($row =$data->fetch_assoc()){//fetch_array,fetch_object to convert data to this format
        
 array_push($student_arr["records"],array(
"id"=>$row['id'],
                "name" => $row['name'],
                "email" => $row['email'],
                "mobile" => $row['mobile'],
                "status" => $row['status'],
                "create_at" => date("Y-m-d",strtotime($row['create_at']))
    
 ));
    }
        http_response_code(503);
        echo json_encode(array(
            "status" => 0,
            "data" => $student_arr["records"]
        ));
    

    
}
    
}else{
    http_response_code(503);
    echo json_encode(array(
        "status" => 0,
        "msg" => "failed to access"
));
}


















?>