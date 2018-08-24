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
include_once '../objects/estudiante.php';

$database = new Database();
$db = $database->getConnection();

$estudiante = new estudiante($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set estudiante property values
$estudiante->id = $data->id;
$estudiante->est_nombres = $data->est_nombres;
$estudiante->est_apellidos = $data->est_apellidos;
$estudiante->estudiante_email = $data->estudiante_email;

// create the product
if($estudiante->create()){
    echo '{';
        echo '"message": "estudiante was created."';
    echo '}';
}	
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to create estudiante."';
    echo '}';
}	
?>