<?php
ini_set("display_errors", 1);
header("Access-Control-Allow-Origin:*");
header("Content-type:application/json;charset=UTF-8");
header("Access-ControlAllow-Methods:POST");

include_once "../config/database.php";
include_once"../classes/student.php";
//$db = new Database();
$connection=$db->connect();
$student=new Student($connection);



if($_SERVER['REQUEST_METHOD']==="POST"){
    $data=json_decode(file_get_contents("php://input"));

    if(!empty($data->name)&& !empty($data->email)&& !empty($data->mobile)){
        $student->name =$data->name;
        $student->email=$data->email;
        $student->mobile=$data->mobile;
        $student->id=$data->id;

if($student->update()){
            http_response_code(200);
            echo json_encode(array(
                "status" => 1,
                "msg" => "student data successfully updated"
            ));
    
}else{
            http_response_code(500);
            echo json_encode(array(
                "status" => 0,
                "msg" => "failed to update data"
            ));
}

        
    }else{
        http_response_code(404);
        echo json_encode(array(
            "status" => 0,
            "msg" => "student not found "
        ));

        
    }



        
 
}else{
    http_response_code(503);
    echo json_encode(array(
        "status" => 0,
        "msg" => "failed to update data"
    ));


    
}