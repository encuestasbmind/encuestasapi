<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate fabricante object
include_once '../objects/fabricante.php';

$database = new Database();
$db = $database->getConnection();

$fabricante = new fabricante($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set fabricante property values
$fabricante->id = $data->id;
$fabricante->nombre_fab = $data->nombre_fab;



// create the product
if($fabricante->create()){
    echo '{';
        echo '"message": "fabricante was created."';
    echo '}';
}	
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to create fabricante."';
    echo '}';
}	
?>