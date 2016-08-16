<?php
require 'config/config.php';
	
/**
* Singleton class for connect.php
*/


class Connect {

	private $mysqli;
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

	public function getConnection() {
		return $this->connection;
	}

	//for the sign up form

	public function insert($dataArr) {
		
		$query = "INSERT INTO users (";
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
	
	public function selectUser(){
 		

 		$iemail = (isset($_POST['email']) ? $_POST['email'] : null);
    	$ipassword = (isset($_POST['password']) ? $_POST['password'] : null);

		$query = "SELECT `email`, `password` FROM users WHERE `email`='$iemail' and `password`='$ipassword';";
		$result = $this-> mysqli->query($query);	
		$num_rows = mysqli_num_rows($result);

		if(isset($_POST)){
			if($num_rows!== 0) {
				while($row = mysqli_fetch_assoc($result)) {
		       		$dbemail    = $row['email'];
		       		$dbpassword = $row['password'];
	        	}
		   			if($iemail==$dbemail && $ipassword == $dbpassword){
		   				$_SESSION['email'] = $iemail;
		   				header('Location: /demo-app/profile.php');		
					}
    		}else{
		    	echo 'unavailable account';
		    	}
		}	
	}

	public function userExists(){
		
		$iemail = (isset($_POST['email']) ? $_POST['email'] : null);
		$query = "SELECT `email` FROM users WHERE `email` = '$iemail';";
	    $result = $this-> mysqli->query($query); 
	    if(isset($_POST)){
	    	if(mysqli_num_rows($result) > 0) {
	           
	            while($row = mysqli_fetch_assoc($result)) {
		       		$dbemail = $row['email'];
	        	}
		   			if($iemail==$dbemail){
		   				return false;	
					}

	   		}else{
	    		return true;
	    	}
		}
	}
		
	public function __destruct() {
		$this->mysqli->close();
	}

}

?>
