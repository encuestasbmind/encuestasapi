<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// include database and object files
include_once '../config/database.php';
include_once '../objects/cursos.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
// prepare product object
$cursos= new cursos($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of product to be edited
$cursos->id = $data->id;
 
// set product property values
$cursos->nombre_cur = $data->nombre_cur;
$cursos->horas = $data->horas;
$cursos->fabricante_id = $data->fabricante_id;
$cursos->categorias_id = $data->categorias_id;
// update the product
if($cursos->update()){
    echo '{';
        echo '"message": "evento was cursos."';
    echo '}';
}
 
// if unable to update the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to update cursos."';
    echo '}';
}
?>