<?php

// get database connection
include_once '../config/database.php';

// instantiate ususario object
include_once '../objects/evento.php';



$database = new Database();
$db = $database->getConnection();

$evento = new evento($db);

$uploaded_file = "C://texto/cargaeventos.csv";

$file = fopen($uploaded_file, "r");
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
 				$evento->id = $getData[0];
				$evento->fecha_inicio = $getData[1];
				$evento->fecha_final = $getData[2];
				$evento->ev_obs = $getData[3];
				$evento->curso_id = $getData[4];
				$evento->instructor_id = $getData[5];
				$evento->tipo_delivery_id = $getData[6];
				$evento->estado_id = $getData[7];
				$evento->ciudad_id = $getData[8];
				$evento->pais_id = $getData[9];
				$evento->estado_evento = $getData[10];
				
				$evento->create();
	         }
			
	fclose($file);	

?>