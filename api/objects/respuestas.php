<?php
class respuestas{
    // database connection and table name
    private $conn;
    private $table_name = "RESPUESTAS";
    
    //object properties
    public $id;
    public $pregunta_id; 
    public $evento_id; 
    public $resp1; 
    public $resp2; 
    public $resp3; 
    public $estudiante_id; 
	
	// constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// create product
	function create(){

		// query to insert record
		$query = "INSERT INTO
					RESPUESTAS
					SET
						ID=:id, PREGUNTA_ID=:preguntaid, EVENTO_ID=:eventoid, RESP1=:resp1, RESP2=:resp2, RESP3=:resp3, ESTUDIANTE_ID=:estudianteid";	

		// prepare query
		$stmt = $this->conn->prepare($query);
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// sanitize
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->pregunta_id=htmlspecialchars(strip_tags($this->pregunta_id));
	    $this->evento_id=htmlspecialchars(strip_tags($this->evento_id));
		$this->resp1=htmlspecialchars(strip_tags($this->resp1));
	    $this->resp2=htmlspecialchars(strip_tags($this->resp2));
	    $this->resp3=htmlspecialchars(strip_tags($this->resp3));	
		$this->estudiante_id=htmlspecialchars(strip_tags($this->estudiante_id));	

		// bind values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":preguntaid", $this->pregunta_id);
		$stmt->bindParam(":eventoid", $this->evento_id);
		$stmt->bindParam(":resp1", $this->resp1);
		$stmt->bindParam(":resp2", $this->resp2);		
		$stmt->bindParam(":resp3", $this->resp3);		
		$stmt->bindParam(":estudianteid", $this->estudiante_id);	
		
		// execute query
		if($stmt->execute()){
			return true;
		}
		return false;
		
	}
    
}
