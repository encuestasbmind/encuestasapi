<?php
class fabricante{
 
    // database connection and table name
    private $conn;
    private $table_name = "fabricante";
 
    // object properties
    public $id;
    public $nombre_fab;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read fabricante
	function read(){
		// select all query
		$query = "SELECT ID AS id, NOMBRE_FAB AS nombre_fab FROM FABRICANTE";
		
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
					FABRICANTE
					SET
						ID=:id, NOMBRE_FAB=:nombre_fab";

		// prepare query
		$stmt = $this->conn->prepare($query);
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// sanitize
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->nombre_fab=htmlspecialchars(strip_tags($this->nombre_fab));
		
		// bind values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":nombre_fab", $this->nombre_fab);
		
		// execute query
		if($stmt->execute()){
			return true;
		}

		return false;
		
	}
}