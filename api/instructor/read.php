<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/instructor.php';

// instantiate database and fabricante object
$database = new Database();
$db = $database->getConnection();

// initialize object
$instructor = new instructor($db);

// query products
$stmt = $instructor->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
	
	// products array
	$instructor_arr=array(); 
	//$evento_arr["records"]=array();
	
	// retrieve our table contents
	// fetch() is faster than fetchAll()
	// http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		// extract row
		// this will make $row['name'] to
		// just $name only
		extract($row);
		$instructor_item=array(
			"id" => $id,
			"nombre_inst" => $nombre_inst,
			"apellidos_inst" => $apellidos_inst,
			"celular_inst" => $celular_inst,
			"fijo_inst" => $fijo_inst,
			"email_1" => $email_1,
			"email_2" => $email_2,

		);
		array_push($instructor_arr, $instructor_item);
	}
	
	echo json_encode($instructor_arr);

}

else {
	
	echo json_encode(
        array("message" => "No instructor found.")
    );

}
?>	