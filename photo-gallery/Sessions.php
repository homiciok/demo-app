<?php 

class Sesssions{
	
	private $isNotLogged = true;
	private $id = null;
	private static $instance;


	private function __construct(){
		session_start();
		$this->$isNotLogged = isset($_SESSION['isNotLogged']) ? $_SESSION['isNotLogged'] : true;
		$this->$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
	}
/*
	public static getInstance(){
			if(!isset(self::$instance)){
			self::$instance = new sessions();
		}  
		return self::$instance;
	}
*/
	public function __get($user){
		if($user == 'isNotLogged'){
			return $this->isNotLogged;
		}else if($user == 'id'){
			return $this->id;
		}
	}

	public function login($id){
		$this->id = $id;
		$this->isNotLogged = false;

		$_SESSION['isNotLogged'] = $this->isNotLogged;
		$_SESSION['id'] = $this->id;

	}

	public function logout(){
		$this->id = null;
		$this->isNotLogged = true;
		
		unset($_SESSION['isNotLogged']);
		unset($_SESSION['id']);
		session_destroy();
	}

}

?>