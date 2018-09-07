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
$evento->id = $data->id;
$evento->fecha_inicio = $data->fecha_inicio;
$evento->fecha_final = $data->fecha_final;
$evento->ev_obs = $data->ev_obs;
$evento->curso_id = $data->curso_id;
$evento->instructor_id = $data->instructor_id;
$evento->tipo_delivery_id = $data->tipo_delivery_id;
$evento->estado_id = $data->estado_id;
$evento->ciudad_id = $data->ciudad_id;
$evento->pais_id = $data->pais_id;
$evento->estado_evento = $data->estado_evento;


// create the product
if($evento->create()){
    echo '{';
        echo '"message": "evento was created."';
    echo '}';
}	
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to create evento."';
    echo '}';
}	
?>