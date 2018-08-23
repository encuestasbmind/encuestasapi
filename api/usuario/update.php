<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/usuario.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$usuario = new usuario($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of product to be edited

$usuario->id = $data->id;

// set product property values
$usuario->usuario = $data->usuario;
$usuario->contrasena = $data->contrasena;
$usuario->fecha_creacion = $data->fecha_creacion;
$usuario->perfil_id = $data->perfil_id; 
// update the product
if($usuario->update()){
    echo '{';
        echo '"message": "Product was updated."';
    echo '}';
}
// if unable to update the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to update product."';
    echo '}';
}

?>