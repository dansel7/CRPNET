<?php 

class ConnManager {
	
	private $usr = "root";
	private $pwd = "va";
	private $host = "localhost";
        private $dbn = "crpnet_db";
	private $conn;
	
	public function connectDB() {
		$this->conn = new mysqli($this->host, $this->usr, $this->pwd, $this->dbn);	
		return $this->conn;
	}
		
	public function runQuery($queryStr) {
		return mysqli_query($this->conn,$queryStr);
	}
        
        public function closeConnDB() {
		mysqli_close($this->conn); 	
	}
	
}
