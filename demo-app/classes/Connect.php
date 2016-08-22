<?php
require 'config/config.php';
	
/**
* Singleton class for connect.php
*/

class Connect {

	public $mysqli;
	private $query;
	private $connection;
	public static $instance;
	
	public static function getInstance(){
		if(!isset(self::$instance)){
			self::$instance = new connect();
		}  
		return self::$instance;
	}

	protected function  __construct(){
		$this->mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	}

	protected function __clone(){

	}

	public static function getConnection() {
		return $this->connection;
	}

	//for the sign up form

	public function insert($dataArr, $table) {
		
		$query = "INSERT INTO ".$table. "(";
		foreach ($dataArr as $key => $value) {
			$query .= "`$key`, ";
		}

		$query = substr($query, 0, -2);
		$query .= ") VALUES (";
		foreach ($dataArr as $key => $value) {
		 	$query .= "'$value', ";
		}

		$query = substr($query, 0, -2);
		$query .= ")";
		$result = $this->mysqli->query($query);
		return $result;
	}
	
	//for the log in form
	
	public function selectUser($email, $password){
 		
		$query = "SELECT * FROM users WHERE `email` = '".$this->mysqli->real_escape_string($email)."' and `password` = '".md5($this->mysqli->real_escape_string($password))."' ;";
		$result = $this-> mysqli->query($query);	
		$num_rows = mysqli_num_rows($result);

		if(isset($_POST)){
			if($num_rows!== 0) {
				while($row = mysqli_fetch_assoc($result)) {
		       		$dbemail    = $row['email'];
		       		$dbpassword = $row['password'];
	      }
		   	if($this->mysqli->real_escape_string($email)== $dbemail && md5($this->mysqli->real_escape_string($password)) == $dbpassword){
		   				$_SESSION['email'] = $this->mysqli->real_escape_string($email);
		   				$_SESSION['user'] = $row;
		   				header('Location: /demo-app/profile.php');		
			  }
    	}else{
		    	echo 'unavailable account';
		  }
		}	
	}

	public function emailExists($email){
		
		$query = "SELECT `email` FROM users WHERE `email` = '".$this->mysqli->real_escape_string($email)."' LIMIT 1;";

	    if (($result = $this-> mysqli->query($query)) && $result->num_rows > 0) {
	    	return true;
	    }
	    return false;
	}
		
	public function __destruct() {
		$this->mysqli->close();
	}

}

?>