<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/evento.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$evento = new evento($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of product to be edited
$evento->id = $data->id;
 
// set product property values
$evento->fecha_inicio = $data->fecha_inicio;
$evento->fecha_final = $data->fecha_final;
$evento->ev_obs = $data->ev_obs;
$evento->curso_id = $data->curso_id;
$evento->instructor_id = $data->instructor_id;
$evento->tipo_delivery_id = $data->tipo_delivery_id;
$evento->estado_id = $data->estado_id;
$evento->ciudad_id = $data->ciudad_id;
$evento->pais_id = $data->pais_id;
 
// update the product
if($evento->update()){
    echo '{';
        echo '"message": "evento was updated."';
    echo '}';
}
 
// if unable to update the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to update evento."';
    echo '}';
}
?>