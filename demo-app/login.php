<?php

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $validator = new Validator();
    $dataArr = [];

    $form_validation = [
    'email'    => 'validRegexEmail', 
    'password' => 'validRegexPassword', 
    ];

    foreach ($form_validation as $key => $rule) {
        $dataArr[$key] = empty($_POST[$key]) ? '' : trim($_POST[$key]);
        if ($validator->isNotEmpty($dataArr[$key],$key)) {
          $validator->$rule($dataArr[$key],$key);
        } 
    }

    $obj = Connect::getInstance();
    $errors = $validator->getErrors();
    $result = $obj->selectUser($dataArr['email'], $dataArr['password']);
}
?>
<!DOCTYPE  html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="/demo-app-2/public/css/style.css">
        <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id = "main">
        	<div id ="login"> 
  	      		<h2 class="text">Login</h2>
  	      		<form action = "<?php $_SERVER["PHP_SELF"];?>" method="post">
      					<label for="email" class="text">Email: </label>
                  <? if (!empty($errors['email'])) { ?>
                  <span class="error"> * <?= $errors['email'] ?></span>
                  <? } ?>
                  <input id="email" name="email" placeholder="email" type="text">
      					<label for="password" class="text">Parola: </label>
                  <? if (!empty($errors['password'])) { ?>
                  <span class="error"> * <?= $errors['password'] ?></span>
                  <? } ?>
                  <input id="password" name="password" placeholder="password" type="password">
      						<input name="submit2" type="submit" value=" Login ">
  	      		</form>
        	</div>
        </div>
   </body>
</html>
