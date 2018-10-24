<?php
class instructor{
 
    // database connection and table name
    private $conn;
    private $table_name = "instructor";
 
    // object properties
    public $id;
    public $nombre_inst;
    public $apellidos_inst;
    public $celular_inst;
    public $fijo_inst;
    public $email_1;
    public $email_2;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read fabricante
	function read(){
		// select all query
		$query = "SELECT ID AS id,
		NOMBRE_INST AS nombre_inst, 
		APELLIDOS_INST AS apellidos_inst,
		CELULAR_INST AS celular_inst,
		FIJO_INST AS fijo_inst,
		EMAIL_1 AS email_1,
		EMAIL_2 AS email_2
		FROM SEBM.INSTRUCTOR";

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
					SEBM.INSTRUCTOR
					SET
						ID=:id, NOMBRE_INST=:nombre_inst, APELLIDOS_INST=:apellidos_inst,CELULAR_INST=:celular_inst,FIJO_INST=:fijo_inst,EMAIL_1=:email_1,EMAIL_2=:email_2";


		// prepare query
		$stmt = $this->conn->prepare($query);
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// sanitize
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->nombre_inst=htmlspecialchars(strip_tags($this->nombre_inst));
	    $this->apellidos_inst=htmlspecialchars(strip_tags($this->apellidos_inst));
	    $this->celular_inst=htmlspecialchars(strip_tags($this->celular_inst));
	    $this->fijo_inst=htmlspecialchars(strip_tags($this->fijo_inst));
	    $this->email_1=htmlspecialchars(strip_tags($this->email_1));
	    $this->email_2=htmlspecialchars(strip_tags($this->email_2));
	 
		
		// bind values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":nombre_inst", $this->nombre_inst);
		$stmt->bindParam(":apellidos_inst", $this->apellidos_inst);
		$stmt->bindParam(":celular_inst", $this->celular_inst);
		$stmt->bindParam(":fijo_inst", $this->fijo_inst);
		$stmt->bindParam(":email_1", $this->email_1);
        $stmt->bindParam(":email_2", $this->email_2);
     
		// execute query
		if($stmt->execute()){
			return true;
		}
		return false;
	}

	function update(){
 
    // update query
    $query = "UPDATE INSTRUCTOR
                
            SET
              nombre_inst=:nombre_inst, 
              apellidos_inst=:apellidos_inst,
              celular_inst=:celular_inst,
              fijo_inst=:fijo_inst,
              email_1=:email_1,
              email_2=:email_2

            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
	$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    // sanitize
    $this->nombre_inst=htmlspecialchars(strip_tags($this->nombre_inst));
    $this->apellidos_inst=htmlspecialchars(strip_tags($this->apellidos_inst));
    $this->celular_inst=htmlspecialchars(strip_tags($this->celular_inst));
    $this->fijo_inst=htmlspecialchars(strip_tags($this->fijo_inst));
    $this->email_1=htmlspecialchars(strip_tags($this->email_1));
    $this->email_2=htmlspecialchars(strip_tags($this->email_2));
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind new values
    $stmt->bindParam(':nombre_inst', $this->nombre_inst);
    $stmt->bindParam(':apellidos_inst', $this->apellidos_inst);
    $stmt->bindParam(':celular_inst', $this->celular_inst);
    $stmt->bindParam(':fijo_inst', $this->fijo_inst);
    $stmt->bindParam(':email_1', $this->email_1);
    $stmt->bindParam(':email_2', $this->email_2);
    $stmt->bindParam(':id', $this->id);
 

     // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}

function readOne(){
 
    // query to read single record
 $query = "SELECT ID AS id,
		NOMBRE_INST AS nombre_inst, 
		APELLIDOS_INST AS apellidos_inst,
		CELULAR_INST AS celular_inst,
		FIJO_INST AS fijo_inst,
		EMAIL_1 AS email_1,
		EMAIL_2 AS email_2

		FROM 
		SEBM.INSTRUCTOR
      
            WHERE
            id=:id";
            

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
    $this->nombre_inst = $row['nombre_inst'];
    $this->apellidos_inst = $row['apellidos_inst'];
    $this->celular_inst=$row['celular_inst'];
    $this->fijo_inst= $row['fijo_inst'];
    $this->email_1 = $row['email_1'];
    $this->email_2 = $row['email_2'];
	
	return $stmt;
}


   }//fin Class

?>