<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
// include database and object files
include_once '../config/database.php';
include_once '../objects/cursos.php'; 
// get database connection
$database = new Database();

$db = $database->getConnection();
// prepare product object
$cursos = new cursos($db); 

// set ID property of product to be edited
$cursos->id = isset($_GET['id']) ? $_GET['id'] : die();
// read the details of product to be edited

$stmt = $cursos->readOne();
$num = $stmt->rowCount();

if($num>0){
// create array
$cursos_arr = array(
    "id" => $cursos->id,
    "nombre_cur" => $cursos->nombre_cur,
    "horas" => $cursos->horas,
    "fabricante_id" => $cursos->fabricante_id,
    "categorias_id" => $cursos->categorias_id
);
// make it json format
print_r(json_encode($cursos_arr));
}else{
	echo json_encode(
        array("message" => "No existen Cursos con el id suministrado")
    );
}

?>