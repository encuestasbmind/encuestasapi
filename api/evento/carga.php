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
include_once '../objects/evento.php';

//Log
$my_file = 'file.txt';
$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
$new_data = "\n".  date("D M d, Y G:i") . ' Inicio';
fwrite($handle, $new_data);


try {

	$database = new Database();
	$db = $database->getConnection();

	$evento = new evento($db);

	// get posted data
	//$data = file_get_contents("php://input");

	$tmp_file = $_FILES["user_file"]["tmp_name"];
	$fx_name = $_FILES["user_file"]["name"];
	$upload_dir = "C://texto/" . $fx_name;
	$moved_file = "C://texto/cargaeventos.csv";

	$new_data = "\n".  date("D M d, Y G:i") . ' Datos obtenidos';
	fwrite($handle, $new_data);

	$new_data = "\n".  date("D M d, Y G:i") . ' Name ' . $fx_name;
	fwrite($handle, $new_data);

	$new_data = "\n".  date("D M d, Y G:i") . ' File ' . $tmp_file;
	fwrite($handle, $new_data);

	move_uploaded_file($tmp_file, $moved_file);

	$new_data = "\n".  date("D M d, Y G:i") . ' Archivo movido ';
	fwrite($handle, $new_data);

	// set evento property values
	//$evento->texto = $data->texto;


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
		
		echo '{';
		echo 	'"message": "Se realizo la carga correctamente"';
		echo '}';
		

} catch (Exception $e) {
	
	    echo '{';
		echo 	'"message": "Hubo errores durante la carga"';
		echo '}';
	
}

if(1){
    echo '{';
        echo '"message": "carga was created."';
    echo '}';
}	
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to create carga archivo."';
    echo '}';
}	

?>