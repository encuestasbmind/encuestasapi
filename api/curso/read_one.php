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
$cursos->readOne();
 
// create array
$cursos_arr = array(
    "id" => $cursos->id,
    "horas" => $cursos->horas,
    "fabricante_id" => $fabricante_id->fecha_final,
    "categorias_id" => $categorias_id->ev_obs
);
 
// make it json format
print_r(json_encode($cursos_arr));
?>