<?php
class eventodesc{
 
    // database connection and table name
    private $conn;
    private $table_name = "evento";
 
    // object properties
    public $id;
    public $curso;
    public $instructor;
    

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read fabricante
	function read(){
		// select all query
		$query = "SELECT ID AS id,
		FECHA_INICIO AS fecha_inicio, 
		FECHA_FINAL AS fecha_final,
		EV_OBS AS ev_obs,
		CURSO_ID AS curso_id,
		INSTRUCTOR_ID AS instructor_id,
		TIPO_DELIVERY_ID AS tipo_delivery_id,
		ESTADO_ID AS estado_id,
		CIUDAD_ID AS ciudad_id,
		PAIS_ID AS pais_id, 
		ESTADO_EVENTO AS estado_evento
		FROM EVENTO";

		// prepare query statement
		$stmt = $this->conn->prepare($query);
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// execute query
		$stmt->execute();
		
		return $stmt;

	}

	function create(){
		
		// query to insert record
		$query = "INSERT INTO
					EVENTO
					SET
						ID=:id, FECHA_INICIO=:fecha_inicio, FECHA_FINAL=:fecha_final,EV_OBS=:ev_obs,CURSO_ID=:curso_id,INSTRUCTOR_ID=:instructor_id,TIPO_DELIVERY_ID=:tipo_delivery_id,ESTADO_ID=:estado_id,CIUDAD_ID=:ciudad_id, PAIS_ID=:pais_id";


		// prepare query
		$stmt = $this->conn->prepare($query);
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// sanitize
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->fecha_inicio=htmlspecialchars(strip_tags($this->fecha_inicio));
	    $this->fecha_final=htmlspecialchars(strip_tags($this->fecha_final));
	    $this->ev_obs=htmlspecialchars(strip_tags($this->ev_obs));
	    $this->curso_id=htmlspecialchars(strip_tags($this->curso_id));
	    $this->instructor_id=htmlspecialchars(strip_tags($this->instructor_id));
	    $this->tipo_delivery_id=htmlspecialchars(strip_tags($this->tipo_delivery_id));
	    $this->estado_id=htmlspecialchars(strip_tags($this->estado_id));
	    $this->ciudad_id=htmlspecialchars(strip_tags($this->ciudad_id));
	    $this->pais_id=htmlspecialchars(strip_tags($this->pais_id));

		
		// bind values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":fecha_inicio", $this->fecha_inicio);
		$stmt->bindParam(":fecha_final", $this->fecha_final);
		$stmt->bindParam(":ev_obs", $this->ev_obs);
		$stmt->bindParam(":curso_id", $this->curso_id);
		$stmt->bindParam(":instructor_id", $this->instructor_id);
        $stmt->bindParam(":tipo_delivery_id", $this->tipo_delivery_id);
        $stmt->bindParam(":estado_id", $this->estado_id);
        $stmt->bindParam(":ciudad_id", $this->ciudad_id);
        $stmt->bindParam(":pais_id", $this->pais_id);
		// execute query
		if($stmt->execute()){
			return true;
		}
		return false;
	}


function update(){
 
    // update query
    $query = "UPDATE EVENTO
                
            SET
              fecha_inicio=:fecha_inicio, 
              fecha_final=:fecha_final,
              ev_obs=:ev_obs,
              curso_id=:curso_id,
              instructor_id=:instructor_id,
              tipo_delivery_id=:tipo_delivery_id,
              estado_id=:estado_id,
              ciudad_id=:ciudad_id,
              pais_id=:pais_id
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
	$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    // sanitize
    $this->fecha_inicio=htmlspecialchars(strip_tags($this->fecha_inicio));
    $this->fecha_final=htmlspecialchars(strip_tags($this->fecha_final));
    $this->ev_obs=htmlspecialchars(strip_tags($this->ev_obs));
    $this->curso_id=htmlspecialchars(strip_tags($this->curso_id));
    $this->instructor_id=htmlspecialchars(strip_tags($this->instructor_id));
    $this->tipo_delivery_id=htmlspecialchars(strip_tags($this->tipo_delivery_id));
    $this->estado_id=htmlspecialchars(strip_tags($this->estado_id));
    $this->ciudad_id=htmlspecialchars(strip_tags($this->ciudad_id));
    $this->pais_id=htmlspecialchars(strip_tags($this->pais_id));
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind new values
    $stmt->bindParam(':fecha_inicio', $this->fecha_inicio);
    $stmt->bindParam(':fecha_final', $this->fecha_final);
    $stmt->bindParam(':ev_obs', $this->ev_obs);
    $stmt->bindParam(':curso_id', $this->curso_id);
    $stmt->bindParam(':instructor_id', $this->instructor_id);
    $stmt->bindParam(':tipo_delivery_id', $this->tipo_delivery_id);
    $stmt->bindParam(':estado_id', $this->estado_id);
    $stmt->bindParam(':ciudad_id', $this->ciudad_id);
    $stmt->bindParam(':pais_id', $this->pais_id);
    $stmt->bindParam(':id', $this->id);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}


function readOne(){
 
    // query to read single record
    $query = "SELECT E.ID AS id, C.NOMBRE_CUR AS curso , I.NOMBRE_INST AS instructor
				FROM EVENTO AS E INNER JOIN CURSO C 
								 ON E.CURSO_ID = C.ID
						INNER JOIN INSTRUCTOR I 
						ON E.INSTRUCTOR_ID = I.ID
				WHERE E.ID = :id";

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
    
    $this->id = $row['id'];
    $this->curso = $row['curso'];
    $this->instructor=$row['instructor'];
	
	return $stmt;
}

}//fin Class

?>
