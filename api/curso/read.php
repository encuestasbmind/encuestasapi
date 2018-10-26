<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/cursos.php';

// instantiate database and fabricante object
$database = new Database();
$db = $database->getConnection();

// initialize object
$curso = new curso($db);

// query products
$stmt = $curso->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
	
	// products array
	$cursos_arr=array();
	//$evento_arr["records"]=array();
	
	// retrieve our table contents
	// fetch() is faster than fetchAll()
	// http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		// extract row
		// this will make $row['name'] to
		// just $name only
		extract($row);
		$cursos_item=array(
			"id" => $id,
			"nombre_cur" => $nombre_cur,
			"horas" => $horas,
			"fabricante_id" => $fabricante_id,
			"categorias_id" => $categorias_id,
		);
		array_push($cursos_arr, $cursos_item);
	}
	
	echo json_encode($cursos_arr);

}

else {
	
	echo json_encode(
        array("message" => "No Cursos found.")
    );

}
?>	