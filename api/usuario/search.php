<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/usuario.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$usuario = new usuario($db);
 
// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";
 
// query products
$stmt = $usuario->search($keywords);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $usuario_arr=array();
    $usuario_arr["records"]=array();
 
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
            "contrasena" =>$contrasena,
            "fecha_creacion" => $fecha_creacion,
            "perfil_id" => $perfil_id,
            
        );
 
        array_push($usuario_arr["records"], $usuario_item);
    }
 
    echo json_encode($usuario_arr);
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>