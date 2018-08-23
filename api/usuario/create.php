<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate ususario object
include_once '../objects/usuario.php';

$database = new Database();

$db = $database->getConnection();

$usuario = new usuario($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set usuario property values
$usuario->id = $data->id;
$usuario->usuario = $data->usuario;
$usuario->contrasena = $data->contrasena;
$usuario->fecha_creacion = $data->fecha_creacion;
$usuario->perfil_id = $data->perfil_id;


// create the product
if($usuario->create()){
    echo '{';
        echo '"message": "usuario was created."';
    echo '}';
}	
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to create usuario."';
    echo '}';
}	
?>