<?php
require_once('UTILS.class.php');

class DAL{

	//private members for configurations
	private $servername = "localhost";
	private $username="sako";
	private $password="123";
	public $dbname="elibrary";
	public $conn = null;

	public function connect() {
		$this->conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);		
	}

	public function escape($str) {
		return $this->conn->real_escape_string($str);
	}

	// retrieve data by sql
	public function getData($sql)
	{	
		$conn = @new mysqli($this->servername,$this->username,$this->password,$this->dbname);
		

		// Works as of PHP 5.2.9 and 5.3.0.
		if ($conn->connect_error) {
			die('Connect Error: ' . $mysqli->connect_error);		    
		   	throw new Exception("");
		}else{
				$result =$conn->query($sql);
				if(!$result)
				{
					throw new Exception("");
				}else{					
					$rows = array();
				
					if($result->num_rows > 0) {
						while($row = mysqli_fetch_assoc($result)) {
							//$rows[] = array('row'=>$row);
							$rows[] = $row;
						}
						
						$json = json_encode($rows);
						return $json;
					}
				}
		}
	}

/////////////////////////////////////////////////////////////////////////

	//execute query insert/update/delete
	function ExecuteQuery($sql)
	{
		$conn = @new mysqli($this->servername,$this->username,$this->password,$this->dbname);
		
		if ($conn->connect_error) {
		   return -2;
		}else{
			$result = $conn->query($sql);
			if(!$result){
   			    return -1;	
			}else{
				return  $conn->insert_id; 
			}
		}
	}

}
?>