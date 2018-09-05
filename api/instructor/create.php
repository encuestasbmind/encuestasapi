<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate ususario object
include_once '../objects/instructor.php';

$database = new Database();
$db = $database->getConnection();

$instructor = new instructor($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set instructor property values
$instructor->id = $data->id;
$instructor->nombre_inst = $data->nombre_inst;
$instructor->apellidos_inst = $data->apellidos_inst;
$instructor->celular_inst = $data->celular_inst;
$instructor->fijo_inst = $data->fijo_inst;
$instructor->email_1 = $data->email_1;
$instructor->email_2 = $data->email_2;

// create the product
if($instructor->create()){
    echo '{';
        echo '"message": "instructor was created."';
    echo '}';
}	
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to create instructor"';
    echo '}';
}	
?>