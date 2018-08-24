<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/estudiante.php';

// instantiate database and fabricante object
$database = new Database();
$db = $database->getConnection();

// initialize object
$estudiante = new estudiante($db);

// query products
$stmt = $estudiante->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
	
	// products array
	$estudiante_arr=array();
	//$estudiante_arr["records"]=array();
	
	// retrieve our table contents
	// fetch() is faster than fetchAll()
	// http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		// extract row
		// this will make $row['name'] to
		// just $name only
		extract($row);
		$estudiante_item=array(
			"id" => $id,
			"est_nombres " => $est_nombres,
			"est_apellidos" => $est_apellidos,
			"estudiante_email" => $estudiante_email,
		);
		array_push($estudiante_arr, $estudiante_item);
	}
	echo json_encode($estudiante_arr);
}
else {
	
	echo json_encode(
        array("message" => "No estudiante found.")
    );

}

?>	