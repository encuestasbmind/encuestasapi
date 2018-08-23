<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/fabricante.php';
echo "leer"
// instantiate database and fabricante object
$database = new Database();
$db = $database->getConnection();

// initialize object
$fabricante = new fabricante($db);

// query products
$stmt = $fabricante->read();
$num = $stmt->rowCount();
echo "leer"
// check if more than 0 record found
if($num>0){
	
	// products array
	$fabricante_arr=array();
	$fabricante_arr["records"]=array();
	
	// retrieve our table contents
	// fetch() is faster than fetchAll()
	// http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		// extract row
		// this will make $row['name'] to
		// just $name only
		extract($row);
		$fabricante_item=array(
			"id" => $id,
			"nombre_fab" => $nombre_fab,
		);
		
		array_push($fabricante_arr["records"], $fabricante_item);
	}
	
	echo json_encode($fabricante_arr);

}

else {
	
	echo json_encode(
        array("message" => "No fabricante found.")
    );

}
?>	
	

