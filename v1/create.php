<?php  
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


        print_r($data);

        $student->name = $data->name;

        $student->email = $data->email;
        $student->mobile = $data->mobile;

        if ($student->create_data()) {
            http_response_code(200);
            echo json_encode(array(
                "status"=>1,
                "msg"=>  "student data has been created successfuly",
            ));
          
            # code...
        } else {
            http_response_code(500);
            echo json_encode(array(
                "status" => 0,
                "msg" => "failed to insert data"
            ));
          
            echo "failed to insert data";
        }
    }else{


        http_response_code(404);
        echo json_encode(array(
            "status" => 0,
            "msg" => "All values required"
        ));

        echo "access denited";
    }
}else{
    http_response_code(503);
    echo json_encode(array(
        "status" => 0,
        "msg" => "failed to insert data"
    ));

    echo "access denited";
 
}