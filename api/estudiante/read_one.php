<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/estudiante.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$estudiante = new estudiante($db);
 
// set ID property of product to be edited
$estudiante->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$stmt = $estudiante->readOne();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
	// create array
	$estudiante_arr = array(
		"id" => $estudiante->id,
	);
	 
	// make it json format
	print_r(json_encode($estudiante_arr));
	
}else{
	
	echo json_encode(
        array("message" => "No existen estudiantes con el id suministrado")
    );
	
}
	
 

?>