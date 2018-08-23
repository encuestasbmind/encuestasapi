<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/evento.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$evento = new evento($db);
 
// set ID property of product to be edited
$evento->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$evento->readOne();
 
// create array
$evento_arr = array(
    "id" => $evento->id,
    "fecha_inicio" => $evento->fecha_inicio,
    "fecha_final" => $evento->fecha_final,
    "ev_obs" => $evento->ev_obs,
	"curso_id" => $evento->curso_id,
	"instructor_id" => $evento->instructor_id,
	"tipo_delivery_id" => $evento->tipo_delivery_id,
	"estado_id" => $evento->estado_id,
	"pais_id" => $evento->pais_id

);
 
// make it json format
print_r(json_encode($evento_arr));
?>