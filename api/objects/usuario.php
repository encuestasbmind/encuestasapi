<?php
class usuario{
 
    // database connection and table name
    private $conn;
    private $table_name = "usuario";
 
    // object properties
    public $id;
    public $usuario;
    public $contrasena;
    public $fecha_creacion;
    public $perfil_id;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read fabricante
	function read(){
		// select all query
		$query = "SELECT ID AS id,  
		USUARIO AS usuario, 
		CONTRASENA AS contrasena, 
		FECHA_CREACION AS fecha_creacion,
		PERFIL_ID AS perfil_id
		FROM USUARIO";

		// prepare query statement
		$stmt = $this->conn->prepare($query);
		
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// execute query
		$stmt->execute();
		
		return $stmt;
	}
	
	// create product
	function create(){
		
		
		// query to insert record
		$query = "INSERT INTO
					USUARIO
					SET
						ID=:id, USUARIO=:usuario, CONTRASENA=:contrasena, FECHA_CREACION=:fecha_creacion, PERFIL_ID=:perfil_id";

		// prepare query
		$stmt = $this->conn->prepare($query);
		
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// sanitize
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->usuario=htmlspecialchars(strip_tags($this->usuario));
	    $this->contrasena=htmlspecialchars(strip_tags($this->contrasena));
	    $this->fecha_creacion=htmlspecialchars(strip_tags($this->fecha_creacion));
	    $this->perfil_id=htmlspecialchars(strip_tags($this->perfil_id));
		
		// bind values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":usuario", $this->usuario);
		$stmt->bindParam(":contrasena", $this->contrasena);
		$stmt->bindParam(":fecha_creacion", $this->fecha_creacion);
		$stmt->bindParam(":perfil_id", $this->perfil_id);

		// execute query
		if($stmt->execute()){
			return true;
		}
		
		return false;

		
	}
	// update the product
function update(){
    // update query
    $query = "UPDATE USUARIO
            SET
                usuario = :usuario,
                contrasena = :contrasena,
                fecha_creacion = :fecha_creacion,
                perfil_id = :perfil_id
            WHERE
                id = :id";
    // prepare query statement
    $stmt = $this->conn->prepare($query);
	$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
    // sanitize
    $this->usuario=htmlspecialchars(strip_tags($this->usuario));
    $this->contrasena=htmlspecialchars(strip_tags($this->contrasena));
    $this->fecha_creacion=htmlspecialchars(strip_tags($this->fecha_creacion));
    $this->perfil_id=htmlspecialchars(strip_tags($this->perfil_id));
    $this->id=htmlspecialchars(strip_tags($this->id));
    // bind new values
    $stmt->bindParam(':usuario', $this->usuario);
    $stmt->bindParam(':contrasena', $this->contrasena);
    $stmt->bindParam(':fecha_creacion', $this->fecha_creacion);
    $stmt->bindParam(':perfil_id', $this->perfil_id);
    $stmt->bindParam(':id', $this->id);
    // execute the query
    if($stmt->execute()){
        return true;
    }
    return false;
}


// search products
function search($keywords){
 
    // select all query
    $query = "SELECT
                *
            FROM
                 USUARIO 

                 WHERE
                 id = :id"
           ;
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
	$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
 
    // bind
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}

function readOne(){
    // query to read single record
     $query = "SELECT ID AS id, 
		USUARIO AS usuario, 
		CONTRASENA AS contrasena, 
		FECHA_CREACION AS fecha_creacion,
		PERFIL_ID AS perfil_id
		FROM USUARIO
            WHERE
         id = :id"
         ;
         
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
	$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // bind id of product to be updated
    $stmt->bindParam(':id', $this->id);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set values to object properties
    $this->usuario = $row['usuario'];
    $this->contrasena = $row['contrasena'];
    $this->fecha_creacion = $row['fecha_creacion'];
    $this->perfil_id = $row['perfil_id'];
}
}