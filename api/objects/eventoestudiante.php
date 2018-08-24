<?php
class eventoestudiante{
	
	    // database connection and table name
    private $conn;
    private $table_name = "evento_estudiante";
	
	// object properties
    public $id;
    public $eveestud;
	public $eventoid;
	public $estudianteid;
	
	// constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// search products
	function readeventoxestudiante(){
		// query to read single record
		$query = "SELECT
                ID AS id, 
                EVE_ESTUD AS eveestud, 
                EVENTO_ID AS eventoid,
                ESTUDIANTE_ID AS estudianteid
				FROM EVENTO_ESTUDIANTE
            WHERE EVENTO_ID=:eventoid AND 
			      ESTUDIANTE_ID=:estudianteid";		
		
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
		
		// bind id of product to be updated
		$stmt->bindParam(':eventoid', $this->eventoid);
		$stmt->bindParam(':estudianteid', $this->estudianteid);
		
		// execute query
		$stmt->execute();
 
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
 
		// set values to object properties
		$this->id = $row['id'];
		$this->eveestud = $row['eveestud'];
		$this->eventoid=$row['eventoid'];
		$this->estudianteid= $row['estudianteid'];
		
	}
	
}