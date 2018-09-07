<?php
 class estudiante{
 
    // database connection and table name
    private $conn;
    private $table_name = "estudiante";
 
    // object properties
    public $id;
    public $est_nombres;
    public $est_apellidos;
    public $estudiante_email;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read fabricante
	function read(){
		// select all query
		$query = "SELECT ID AS id,  
		EST_NOMBRES AS est_nombres, 
		EST_APELLIDOS AS est_apellidos, 
		ESTUDIANTE_EMAIL AS estudiante_email
		FROM SEBM.ESTUDIANTE";

		// prepare query statement
		$stmt = $this->conn->prepare($query);
		
		// execute query
		$stmt->execute();
		
		return $stmt;
	}

	function create(){
		
		// query to insert record
		$query = "INSERT INTO
					SEBM.ESTUDIANTE
					SET
						ID=:id, EST_NOMBRES=:est_nombres, EST_APELLIDOS=:est_apellidos, ESTUDIANTE_EMAIL=:estudiante_email";

		// prepare query
		$stmt = $this->conn->prepare($query);
		// sanitize
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->est_nombres=htmlspecialchars(strip_tags($this->est_nombres));
	    $this->est_apellidos=htmlspecialchars(strip_tags($this->est_apellidos));
	    $this->estudiante_email=htmlspecialchars(strip_tags($this->estudiante_email));
	   
		// bind values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":est_nombres", $this->est_nombres);
		$stmt->bindParam(":est_apellidos", $this->est_apellidos);
		$stmt->bindParam(":estudiante_email", $this->estudiante_email);
		// execute query
		if($stmt->execute()){
			return true;
		}
		return false;
	}

	function readOne(){
 
    // query to read single record
    $query = "SELECT
                ID AS id

            FROM
                SEBM.ESTUDIANTE
               
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
	
	return $stmt;
}
 }	

?>