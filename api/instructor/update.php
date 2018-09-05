<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/instructor.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$instructor = new instructor($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of product to be edited
$instructor->id = $data->id;
 
// set product property values
$instructor->id = $data->id;
$instructor->nombre_inst = $data->nombre_inst;
$instructor->apellidos_inst = $data->apellidos_inst;
$instructor->celular_inst = $data->celular_inst;
$instructor->fijo_inst = $data->fijo_inst;
$instructor->email_1 = $data->email_1;
$instructor->email_2 = $data->email_2;
// update the product
if($instructor->update()){
    echo '{';
        echo '"message": "instructor was updated."';
    echo '}';
}
 
// if unable to update the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to update instructor."';
    echo '}';
}
?>