<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/eventoestudiante.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$eventoestudiante = new eventoestudiante($db);

// set ID property of product to be edited
$eventoestudiante->eventoid = isset($_GET['eventoid']) ? $_GET['eventoid'] : die();
$eventoestudiante->estudianteid = isset($_GET['estudianteid']) ? $_GET['estudianteid'] : die();

// read the details of product to be edited
$eventoestudiante->readeventoxestudiante();

// create array
$item_arr = array(
    "id" =>  $eventoestudiante->id,
    "eveestud" => $eventoestudiante->eveestud,
    "eventoid" => $eventoestudiante->eventoid,
    "estudianteid" => $eventoestudiante->estudianteid
);

// make it json format
print_r(json_encode($item_arr));

?>