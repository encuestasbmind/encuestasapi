<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/usuario.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$usuario = new usuario($db);
 
// set ID property of product to be edited
$usuario->id = isset($_GET['id']) ? $_GET['id'] : die();


 
// read the details of product to be edited
$usuario->readOne();
 
// create array
$usuario_arr = array(
    "id" =>  $usuario->id,
    "usuario" => $usuario->usuario,
    "contrasena" => $usuario->contrasena,
    "fecha_creacion" => $usuario->fecha_creacion,
    "perfil_id" => $usuario->perfil_id
);
 
// make it json format
print_r(json_encode($usuario_arr));
?>