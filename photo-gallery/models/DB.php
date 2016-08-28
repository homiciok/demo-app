<?php
require 'config/config.php';

/**
* Singleton class for DB.php
*/

class DB {

	public $mysqli;
	private $query;
	private $connection;
	public static $instance;
	
	public static function getInstance(){
		if(!isset(self::$instance)){
			self::$instance = new db();
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

	public function makeQuery($query){
		$queryInput = $query;
		$result = $this->mysqli->query($queryInput);
		return $result;
	}



	function uploadImages(){
		$img = isset($_FILES['userfile']) ? $_FILES['userfile'] : '';
      //$obj = Connect::getInstance();

		$img_desc = $this->reorderArray($img);

		foreach($img_desc as $value)
		{   
			$newname = date('Y-m-d H:i:s_',time()).mt_rand().'.jpg';
			$moved = move_uploaded_file($value['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/demo-app-2/images/" . $newname); 
			$path = $_SERVER['DOCUMENT_ROOT'] . "/demo-app-2/images/";
			$user_id = $_SESSION['id'];
			$query = "INSERT INTO `images` (`name`, `path`, `user_id`) VALUES ('$newname', '$path', '$user_id');";
			$result = $this-> mysqli->query($query);
		}
		if(isset($result)){
			echo "Successful upload";

		}else{
			echo "Unsuccessful upload";
		}  
	}

	public function insert($dataArr, $table){

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

	public function emailExists($email){
		
		$query = "SELECT `email` FROM users WHERE `email` = '".$this->mysqli->real_escape_string($email)."' LIMIT 1;";

		if (($result = $this-> mysqli->query($query)) && $result->num_rows > 0) {
			return true;
		}
		return false;
	}


	public function getImages(){

		$userId = $_SESSION['id'];
		$query = "SELECT * FROM `images` WHERE `user_id` = '$userId';";
		$result = $this->mysqli->query($query);
		
		while($row = mysqli_fetch_assoc($result)) {
			$content = $row['name'];
			$link = $row['path'];
			$userId = $row['user_id'];
			//echo "<img src='http://localhost/demo-app-2/images/".$content."' />";
		}
		
	}  


	public function __destruct() {
		$this->mysqli->close();
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

}


?>