<?php
class cursos{
 
    // database connection and table name
    private $conn;
    private $table_name = "curso";
 
    // object properties
    public $id;
    public $nombre_cur;
    public $horas;
    public $fabricante_id;
    public $categorias_id;
   

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read fabricante
	function read(){
		// select all query
		$query = "SELECT ID AS id,
		NOMBRE_CUR AS nombre_cur, 
		HORAS AS horas,
		FABRICANTE_ID AS fabricante_id,
		CATEGORIAS_ID AS categorias_id
		FROM SEBM.CURSO";

		// prepare query statement
		$stmt = $this->conn->prepare($query);
		
		// execute query
		$stmt->execute();
		
		return $stmt;

	}

	function create(){
		
		// query to insert record
		$query = "INSERT INTO
					SEBM.CURSO
					SET
			            ID=:id, NOMBRE_CUR=:nombre_cur, HORAS=:horas,FABRICANTE_ID=:fabricante_id,CATEGORIAS_ID=:categorias_id";


		// prepare query
		$stmt = $this->conn->prepare($query);
		// sanitize
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->nombre_cur=htmlspecialchars(strip_tags($this->nombre_cur));
	    $this->horas=htmlspecialchars(strip_tags($this->horas));
	    $this->fabricante_id=htmlspecialchars(strip_tags($this->fabricante_id));
	    $this->categorias_id=htmlspecialchars(strip_tags($this->categorias_id));
	    
		
		// bind values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":nombre_cur", $this->nombre_cur);
		$stmt->bindParam(":horas", $this->horas);
		$stmt->bindParam(":fabricante_id", $this->fabricante_id);
		$stmt->bindParam(":categorias_id", $this->categorias_id);
		// execute query
		if($stmt->execute()){
			return true;
		}
		return false;
	}

function update(){
 
    // update query
    $query = "UPDATE CURSO
                
            SET
              nombre_cur=:nombre_cur, 
              horas=:horas,
              fabricante_id=:fabricante_id,
              categorias_id=:categorias_id
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->nombre_cur=htmlspecialchars(strip_tags($this->nombre_cur));
    $this->horas=htmlspecialchars(strip_tags($this->horas));
    $this->fabricante_id=htmlspecialchars(strip_tags($this->fabricante_id));
    $this->categorias_id=htmlspecialchars(strip_tags($this->categorias_id));
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind new values
    $stmt->bindParam(':nombre_cur', $this->nombre_cur);
    $stmt->bindParam(':horas', $this->horas);
    $stmt->bindParam(':fabricante_id', $this->fabricante_id);
    $stmt->bindParam(':categorias_id', $this->categorias_id);
    $stmt->bindParam(':id', $this->id);
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}

function readOne(){
 
    // query to read single record
    $query = "SELECT
                ID AS id, 
                NOMBRE_CUR AS nombre_cur, 
                HORAS AS horas,
                FABRICANTE_ID AS fabricante_id,
                CATEGORIAS_ID AS categorias_id

            FROM
                SEBM.CURSO
               
            WHERE
            id=:id";
            

    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(':id', $this->id);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->nombre_cur = $row['nombre_cur'];
    $this->horas = $row['horas'];
    $this->fabricante_id=$row['fabricante_id'];
    $this->categorias_id= $row['categorias_id'];

    return $stmt;
}

}//class

?>