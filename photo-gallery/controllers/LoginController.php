<?php
require("Validator.php");

class LoginController{


    function validateInput(){
        $dataArr = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $validator = new Validator();

        $form_validation = [
        'name'    => 'validRegexName', 
        'surname' => 'validRegexName', 
        'email'   => 'validRegexEmail', 
        'password'=> 'validRegexPassword'
        ];

        foreach ($form_validation as $key => $rule) {
            $dataArr[$key] = empty($_POST[$key]) ? '' : trim($_POST[$key]);
            if ($validator->isNotEmpty($dataArr[$key],$key)) {
              $validator->$rule($dataArr[$key],$key);
            } 
        }
        }   
        $obj = DB::getInstance();
        $errors = $validator->getErrors();
        $result = $obj->selectUser($dataArr['email'], $dataArr['password']);
    }

}
?>