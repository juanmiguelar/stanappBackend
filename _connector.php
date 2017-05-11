<?php
class DBController {
	 private $host = "127.0.0.1";
	 private $user = "juanmiguelar09";
	 private $pass = "";
	 private $db = "db";
	 private $conn = null;
	
	function __construct() {
		$conn = $this->connectDB();
		if(!empty($conn)) {
			$this->selectDB($conn);
		}
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db)or die(mysqli_error());
		return $conn;
	}
	
	function selectDB($conn) {
		mysqli_select_db($conn, $this->db) 
			or die("problemas al conectar la bd");
	}
	
	function runQuery($query) {
		$result = mysqli_query($query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
			
	}
	
	function runInsertQuery($query) {
		$result = mysql_query($query, $this->connectDB());
		if ($result == null) {
			# code...
			return false;
		}else{
			return true;
		}		
	}
	
	function numRows($query) {
		$result  = mysql_query($query);
		$rowcount = mysql_num_rows($result);
		return $rowcount;	
	}
}
?>
