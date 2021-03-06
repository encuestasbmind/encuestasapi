<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/usuario.php';

//Log
$my_file = 'file.txt';
$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
$new_data = "\n".  date("D M d, Y G:i") . ' Inicio';
fwrite($handle, $new_data);


try{

// instantiate database and fabricante object
$database = new Database();
$db = $database->getConnection();
$usuario = new usuario($db);

$new_data = "\n".  date("D M d, Y G:i") . ' Base de datos conectada';
fwrite($handle, $new_data);

// initialize object


$new_data = "\n".  date("D M d, Y G:i") . ' Usuario creado';
fwrite($handle, $new_data);

// query products
$stmt = $usuario->read();
$num = $stmt->rowCount();

$new_data = "\n".  date("D M d, Y G:i") . ' Comando de base de datos ejecutados';
fwrite($handle, $new_data);

// check if more than 0 record found
if($num>0){
	
	// products array
	$usuario_arr=array();
	$usuario_arr=array();
	
	// retrieve our table contents
	// fetch() is faster than fetchAll()
	// http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		// extract row
		// this will make $row['name'] to
		// just $name only
		extract($row);
		$usuario_item=array(
			"id" => $id,
			"usuario" => $usuario,
			"contrasena" => $contrasena,
			"fecha_creacion" => $fecha_creacion,
			"perfil_id" => $perfil_id,

		);
		array_push($usuario_arr, $usuario_item);
	}
	
	
	echo json_encode($usuario_arr);

}else{
	
	echo $num;

	echo json_encode(
        array("message" => "No fabricante found.")
    );

}

} catch (Exception $e) {
	
	echo 'Caught exception: ',  $e->getMessage(), "\n";
	
}	
	
?>	