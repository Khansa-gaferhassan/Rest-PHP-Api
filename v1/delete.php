<?php
ini_set("display_errors", 1);

header("Access-Control-Allow-Origin:*");

header("Access-ControlAllow-Methods:*");



include_once "../config/database.php";
include_once "../classes/student.php";
//$db = new Database();
$connection = $db->connect();

$student = new Student($connection);

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $student_id = isset($_GET['id']) ? intval($_GET['id']) : "";

    if (!empty($student_id)) {
        $student->id= $student_id;
        if ($student->delete_student()) {
            http_response_code(200);
            echo json_encode(array(
                "status" => 1,
                "msg" => "student deleted successfully"
            ));

            # code...
        } else {
            http_response_code(500);
            echo json_encode(array(
                "status" => 0,
                "msg" => "failed to deleted data"
            ));

        }
        
        # code...
    } else {
        http_response_code(404);
        echo json_encode(array(
            "status" => 0,
            "msg" => "All data nerded"
        ));

    }
    
    

}else{

    http_response_code(503);
    echo json_encode(array(
        "status" => 0,
        "msg" => "Access denited"
    ));

    
}



?>