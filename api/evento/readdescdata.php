<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/eventodesc.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$eventodesc = new eventodesc($db);
 
// set ID property of product to be edited
$eventodesc->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$stmt = $eventodesc->readOne();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
	// create array
	$evento_arr = array(
		"id" => $eventodesc->id,
		"curso" => $eventodesc->curso,
		"instructor" => $eventodesc->instructor
	);
	 
	// make it json format
	print_r(json_encode($evento_arr));
	
    }else{
	    echo json_encode(
        array("message" => "No existen eventos con el id suministrados")
        );
    }

?>