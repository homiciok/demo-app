<?php

class Validator{

  private $errors = [];

  public function __construct(){
    $this->errors = [];
  }

  public function isNotEmpty($input, $index){
    if (empty($input)) {
      $this->errors[$index] = "Please enter a value";
      return false;
    } 
    return true;
  }

  public function validRegexName($input, $index){
    if (!preg_match("/^[a-zA-Z ]*$/", $input)) {
     $this->errors[$index] = "Only letters and whitespaces";
     return false;
   }	
   return true;
 }

 public function validRegexPassword($input, $index){
  if (!preg_match("/^S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $input)) {
   $this->errors[$index] = "Length of 8, at least one uppercase and at least one number";		
   return false;
 }
 return true;
}

public function validRegexEmail($input, $index){
  if (!preg_match("/^([a-z0-9+_-]+)(.[a-z0-9+_-]+)*@([a-z0-9-]+.)+[a-z]{2,6}$/ix", $input)) {
   $this->errors[$index] = "Not a valid email adress";
   return false;
 }
 return true;
}

public function getErrors(){
  return $this->errors;
}

}

?>