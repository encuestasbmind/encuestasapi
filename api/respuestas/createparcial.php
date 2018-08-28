<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate fabricante object
include_once '../objects/respuestas.php';

$database = new Database();
$db = $database->getConnection();

$respuestas = new respuestas($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

$verifica_errores = 0;

// pregunta 1
$respuestas->id = NULL;
$respuestas->pregunta_id = 1;
$respuestas->evento_id = $data->eventoid;
$respuestas->resp1 = NULL;
$respuestas->resp2 = $data->comentarios1;
$respuestas->resp3 = $data->rtasSiNo_1;
$respuestas->estudiante_id = 0;

if(!$respuestas->create()){
	$verifica_errores = 1;
}

// pregunta 2
$respuestas->id = NULL;
$respuestas->pregunta_id = 2;
$respuestas->evento_id = $data->eventoid;
$respuestas->resp1 = NULL;
$respuestas->resp2 = $data->comentarios2;
$respuestas->resp3 = $data->rtasSiNo_2;
$respuestas->estudiante_id = 0;

if(!$respuestas->create()){
	$verifica_errores = 1;
}

// pregunta 3
$respuestas->id = NULL;
$respuestas->pregunta_id = 3;
$respuestas->evento_id = $data->eventoid;
$respuestas->resp1 = NULL;
$respuestas->resp2 = $data->comentarios3;
$respuestas->resp3 = $data->rtasSiNo_3;
$respuestas->estudiante_id = 0;

if(!$respuestas->create()){
	$verifica_errores = 1;
}

// pregunta 4
$respuestas->id = NULL;
$respuestas->pregunta_id = 4;
$respuestas->evento_id = $data->eventoid;
$respuestas->resp1 = NULL;
$respuestas->resp2 = $data->comentarios4;
$respuestas->resp3 = $data->rtasSiNo_4;
$respuestas->estudiante_id = 0;

if(!$respuestas->create()){
	$verifica_errores = 1;
}

// pregunta 5
$respuestas->id = NULL;
$respuestas->pregunta_id = 5;
$respuestas->evento_id = $data->eventoid;
$respuestas->resp1 = NULL;
$respuestas->resp2 = $data->comentarios5;
$respuestas->resp3 = $data->rtasSiNo_5;
$respuestas->estudiante_id = 0;

if(!$respuestas->create()){
	$verifica_errores = 1;
}

// create the product
if($verifica_errores == 0){
    echo '{';
        echo '"message": "Respuestas creadas"';
    echo '}';
}	
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Hubo errores en la creación de las respuestas"';
    echo '}';
}	

	
?>