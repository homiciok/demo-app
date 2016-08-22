<?php


 class User{

 	private $data;
 	private $id;
 	private $name;
 	private $surname;
 	private $email;
 	private $password;	

 	function __construct($id=null, $name=null, $surname=null, $email=null, $password=null){
 		$this->id = $id;
 		$this->name = $name;
 		$this->surname = $surname;
 		$this->email = $email;
 		$this->password = $password;

  }
 	
 	public function getUser(){
 		
 	}

 	public function login(){
		
	}

	public function signup($array){
		$obj = Connect::getInstance();
		if(!$this->obj->insert($array)){
			echo "There is an error in creating your account";
		}
	}

	public function logout(){

	}

}


?>