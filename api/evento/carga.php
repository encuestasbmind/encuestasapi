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
include_once '../objects/evento.php';

$database = new Database();
$db = $database->getConnection();

$evento = new evento($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set evento property values
$evento->texto = $data->texto;

if($evento->create()){
    echo '{';
        echo '"message": "carga was created."';
    echo '}';
}	
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to create carga."';
    echo '}';
}	

?>