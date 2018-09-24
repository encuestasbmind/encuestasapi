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

// pregunta 1 (6) comentario 1
$respuestas->id = NULL;
$respuestas->pregunta_id = 6;
$respuestas->evento_id = $data->eventoid;
$respuestas->resp1 = $data->rtas_1;
$respuestas->resp2 = $data->comentarios1;
$respuestas->resp3 = NULL;
$respuestas->estudiante_id = 0;

if(!$respuestas->create()){
	$verifica_errores = 1;
}

// pregunta 2 (7)
$respuestas->id = NULL;
$respuestas->pregunta_id = 7;
$respuestas->evento_id = $data->eventoid;
$respuestas->resp1 = $data->rtas_2;
$respuestas->resp2 = NULL;
$respuestas->resp3 = NULL;
$respuestas->estudiante_id = 0;

if(!$respuestas->create()){
	$verifica_errores = 1;
}

// pregunta 3 (8)
$respuestas->id = NULL;
$respuestas->pregunta_id = 8;
$respuestas->evento_id = $data->eventoid;
$respuestas->resp1 = $data->rtas_3;
$respuestas->resp2 = NULL;
$respuestas->resp3 = NULL;
$respuestas->estudiante_id = 0;

if(!$respuestas->create()){
	$verifica_errores = 1;
}

// pregunta 4 (9) comentario 2
$respuestas->id = NULL;
$respuestas->pregunta_id = 9;
$respuestas->evento_id = $data->eventoid;
$respuestas->resp1 = $data->rtas_4;
$respuestas->resp2 = $data->comentarios2;
$respuestas->resp3 = NULL;
$respuestas->estudiante_id = 0;

if(!$respuestas->create()){
	$verifica_errores = 1;
}

// pregunta 5 (10)
$respuestas->id = NULL;
$respuestas->pregunta_id = 10;
$respuestas->evento_id = $data->eventoid;
$respuestas->resp1 = $data->rtas_5;
$respuestas->resp2 = NULL;
$respuestas->resp3 = NULL;
$respuestas->estudiante_id = 0;

if(!$respuestas->create()){
	$verifica_errores = 1;
}

// pregunta 6 (11) comentario 3
$respuestas->id = NULL;
$respuestas->pregunta_id = 11;
$respuestas->evento_id = $data->eventoid;
$respuestas->resp1 = $data->rtas_6;
$respuestas->resp2 = $data->comentarios3;
$respuestas->resp3 = NULL;
$respuestas->estudiante_id = 0;

if(!$respuestas->create()){
	$verifica_errores = 1;
}

// pregunta 7 (12)
$respuestas->id = NULL;
$respuestas->pregunta_id = 12;
$respuestas->evento_id = $data->eventoid;
$respuestas->resp1 = $data->rtas_7;
$respuestas->resp2 = NULL;
$respuestas->resp3 = NULL;
$respuestas->estudiante_id = 0;

if(!$respuestas->create()){
	$verifica_errores = 1;
}

// pregunta 8 (13)
$respuestas->id = NULL;
$respuestas->pregunta_id = 13;
$respuestas->evento_id = $data->eventoid;
$respuestas->resp1 = $data->rtas_8;
$respuestas->resp2 = NULL;
$respuestas->resp3 = NULL;
$respuestas->estudiante_id = 0;

if(!$respuestas->create()){
	$verifica_errores = 1;
}

// pregunta 9 (14) comentario 4
$respuestas->id = NULL;
$respuestas->pregunta_id = 14;
$respuestas->evento_id = $data->eventoid;
$respuestas->resp1 = $data->rtas_9;
$respuestas->resp2 = $data->comentarios4;
$respuestas->resp3 = NULL;
$respuestas->estudiante_id = 0;

if(!$respuestas->create()){
	$verifica_errores = 1;
}

// pregunta 10 (15)
$respuestas->id = NULL;
$respuestas->pregunta_id = 15;
$respuestas->evento_id = $data->eventoid;
$respuestas->resp1 = $data->rtas_10;
$respuestas->resp2 = NULL;
$respuestas->resp3 = NULL;
$respuestas->estudiante_id = 0;

if(!$respuestas->create()){
	$verifica_errores = 1;
}

// pregunta 11 (16)
$respuestas->id = NULL;
$respuestas->pregunta_id = 16;
$respuestas->evento_id = $data->eventoid;
$respuestas->resp1 = $data->rtas_11;
$respuestas->resp2 = NULL;
$respuestas->resp3 = NULL;
$respuestas->estudiante_id = 0;

if(!$respuestas->create()){
	$verifica_errores = 1;
}

// pregunta 12 (17) comentario 5
$respuestas->id = NULL;
$respuestas->pregunta_id = 17;
$respuestas->evento_id = $data->eventoid;
$respuestas->resp1 = $data->rtas_12;
$respuestas->resp2 = $data->comentarios5;
$respuestas->resp3 = NULL;
$respuestas->estudiante_id = 0;

if(!$respuestas->create()){
	$verifica_errores = 1;
}

// pregunta 13 (18) comentario 6
$respuestas->id = NULL;
$respuestas->pregunta_id = 18;
$respuestas->evento_id = $data->eventoid;
$respuestas->resp1 = $data->rtas_13;
$respuestas->resp2 = $data->comentarios6;
$respuestas->resp3 = NULL;
$respuestas->estudiante_id = 0;

if(!$respuestas->create()){
	$verifica_errores = 1;
}

// pregunta 14 (19) comentario 16
$respuestas->id = NULL;
$respuestas->pregunta_id = 19;
$respuestas->evento_id = $data->eventoid;
$respuestas->resp1 = 0;
$respuestas->resp2 = $data->comentarios7;
$respuestas->resp3 = NULL;
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