<?php 
 
 class User{

 	private $id;
 	private $name;
 	private $surname;
 	private $query;
 	private $email;
 	private $password;
 	public static $instance;


 	public static function getInstance(){
 		if(!isset(self::$instance)){
			self::$instance = new user();
		}  
		return self::$instance;
	}

	public function deleteUser(){
		$query = "DELETE FROM `users` WHERE `email` = '".$this->mysqli->real_escape_string($email)."' and `password` = '".md5($this->mysqli->real_escape_string($password))."' ; "
		$result = $this->query($query);
		return $result;
	}

	public function selectUser(){
		$query = "SELECT * FROM users WHERE `email` = '".$this->mysqli->real_escape_string($email)."' and `password` = '".md5($this->mysqli->real_escape_string($password))."' ;";
		$result = $this->mysqli->query($query);	
		$num_rows = mysqli_num_rows($result);

		if($num_rows!== 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$dbemail    = $row['email'];
				$dbpassword = $row['password'];
				$dbId = $row['id'];
			}

			if($this->mysqli->real_escape_string($email)== $dbemail && md5($this->mysqli->real_escape_string($password)) == $dbpassword){
				$_SESSION['email'] = $this->mysqli->real_escape_string($email);
				$_SESSION['id'] = $this->mysqli->real_escape_string($dbId);
			}
		}else{
			echo 'unavailable account';
		}
	}	


 	public function saveUser($dataArr, $table){

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
		$result = DB::getInstance()->mysqli->query($query);
		return $result;
 	} 
 }

 ?>