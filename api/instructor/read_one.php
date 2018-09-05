<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/instructor.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$instructor = new instructor($db);
 
// set ID property of product to be edited
$instructor->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$stmt = $instructor->readOne();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
	// create array
	$instructor_arr = array(
		"id" => $instructor->id,
		"nombre_inst" => $instructor->nombre_inst,
		"apellidos_inst" => $instructor->apellidos_inst,
		"celular_inst" => $instructor->celular_inst,
		"fijo_inst" => $instructor->fijo_inst,
		"email_1" => $instructor->email_1,
		"email_2" => $instructor->email_2

	);
	 
	// make it json format
	print_r(json_encode($instructor_arr));
	
}else{
	
	echo json_encode(
        array("message" => "No existe instructor con el id suministrado")
    );
	
}
	
 

?>