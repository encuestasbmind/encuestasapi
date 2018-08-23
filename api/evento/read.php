<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/evento.php';

// instantiate database and fabricante object
$database = new Database();
$db = $database->getConnection();

// initialize object
$evento = new evento($db);

// query products
$stmt = $evento->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
	
	// products array
	$evento_arr=array();
	//$evento_arr["records"]=array();
	
	// retrieve our table contents
	// fetch() is faster than fetchAll()
	// http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		// extract row
		// this will make $row['name'] to
		// just $name only
		extract($row);
		$evento_item=array(
			"id" => $id,
			"fecha_inicio" => $fecha_inicio,
			"fecha_final" => $fecha_final,
			"ev_obs" => $ev_obs,
			"curso_id" => $curso_id,
			"instructor_id" => $instructor_id,
			"tipo_delivery_id" => $tipo_delivery_id,
			"estado_id" => $estado_id,
			"pais_id" => $pais_id,

		);
		array_push($evento_arr, $evento_item);
	}
	
	echo json_encode($evento_arr);

}

else {
	
	echo json_encode(
        array("message" => "No fabricante found.")
    );

}
?>	