<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/eventodescfinal.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$eventodescfinal = new eventodescfinal($db);
 
// set ID property of product to be edited
$eventodescfinal->id = isset($_GET['id']) ? $_GET['id'] : die();
$eventodescfinal->estudiante_id = isset($_GET['estudiante_id']) ? $_GET['estudiante_id'] : die();
 
// read the details of product to be edited
$stmt = $eventodescfinal->readOne();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
	// create array
	$evento_arr = array(
    "id"=> $eventodescfinal->id,
    "instructor" => $eventodescfinal->instructor,
    "estudiante_id" => $eventodescfinal->estudiante_id,
    "nombres"=> $eventodescfinal->nombres,
    "apellidos"=> $eventodescfinal->apellidos,
    "email"=> $eventodescfinal->email
	);
	// make it json format
	print_r(json_encode($evento_arr));
}else{
	echo json_encode(
        array("message" => "No existen eventos con el id suministrado")
    );
}
	