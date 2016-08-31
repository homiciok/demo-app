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
		$this->mysqli= new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
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
		$result = $this->mysqli->query($query);	
		$num_rows = mysqli_num_rows($result);

		if(isset($_POST)){
			if($num_rows!== 0) {
				while($row = mysqli_fetch_assoc($result)) {
					$dbemail    = $row['email'];
					$dbpassword = $row['password'];
					$dbId = $row['id'];

				}
				if($this->mysqli->real_escape_string($email)== $dbemail && md5($this->mysqli->real_escape_string($password)) == $dbpassword){
					$_SESSION['email'] = $this->mysqli->real_escape_string($email);
					$_SESSION['id'] = $this->mysqli->real_escape_string($dbId);
					header('Location: /demo-app-2/profile.php');
				}
			}
		}	
	}

	function uploadImages($img){
		//$img = isset($_FILES['userfile']) ? $_FILES['userfile'] : '';
      //$obj = Connect::getInstance();

		$img_desc = $this->reorderArray($img);

		foreach($img_desc as $value)
		{   
			$newname = date('Y-m-d H:i:s_',time()).mt_rand().'.jpg';
			$moved = move_uploaded_file($value['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/demo-app-2/images/" . $newname); 
			$path = $_SERVER['DOCUMENT_ROOT'] . "/demo-app-2/images/";
			$user_id = $_SESSION['id'];
			$query = "INSERT INTO `images` (`name`, `path`, `user_id`) VALUES ('$newname', '$path', '$user_id');";
			$result = $this->mysqli->query($query);
			
		}
		if(isset($result)){
			header('Location: /demo-app-2/profile.php');
		}else{
			echo "Unssuccesful";
		}  
	}


	function reorderArray($image)
	{	
		$imgArr = array();
		$img_count = count($image['name']);
		$img_key = array_keys($image);
		
		for($i=0; $i<$img_count; $i++)
		{
			foreach($img_key as $value)
			{
				$imgArr[$i][$value] = $image[$value][$i];
			}
		}
		return $imgArr;
	}

	
	public function emailExists($email){
		
		$query = "SELECT `email` FROM users WHERE `email` = '".$this->mysqli->real_escape_string($email)."' LIMIT 1;";

		if (($result = $this-> mysqli->query($query)) && $result->num_rows > 0) {
			return true;
		}
		return false;
	}


		public function getImages($userId){

			$i = 0;
			$imageArray = [];
			$query = "SELECT * FROM `images` WHERE `user_id` = '$userId';";
			$result = $this->mysqli->query($query);
			while($row = mysqli_fetch_assoc($result)) {
				if ($userId = $_SESSION['id']){}
					foreach ($row as $key => $value) {
						$imageArray[$i] = $row['name'];
					}
					$i++;
				}
				return $imageArray;
		}	
					
						

	public function __destruct() {
		$this->mysqli->close();
	}

}


?>
	