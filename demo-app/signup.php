<?php

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$validator = new Validator();
	$dataArr = [];

	$form_validation = [
	'name'    => 'validRegexName', 
	'surname' => 'validRegexName', 
	'email'   => 'validRegexEmail', 
	'password'=> 'validRegexPassword'
	];

	$confirm_password = $_POST['confirm_password'];
	
	foreach ($form_validation as $key => $rule) {
			$dataArr[$key] = empty($_POST[$key]) ? '' : trim($_POST[$key]);
			if ($validator->isNotEmpty($dataArr[$key],$key)) {
	  	 	$validator->$rule($dataArr[$key],$key);
			}	
	}

	$obj = Connect::getInstance();
	$errors = $validator->getErrors();
	
	$result = $obj->userExists();
	if(!empty($errors)){
		print_r("No text set yet.");
	}else{

		if($dataArr['password'] === $confirm_password){
		$result = $obj->insert($dataArr);
		header('Location: ' . $_SERVER['PHP_SELF']);
		exit;
		}else{
				echo "passwords does not match";
		}
	}
	}	
?>
<!DOCTYPE  html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Register Form in PHP</title>
        <link rel="stylesheet" href="<?= $app_paths?>style.css">
        <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id = "main">
        	<div id ="login"> 
  	      		<h2 class="text">Sign up</h2>
  	      		<form action = "<?php $_SERVER['PHP_SELF'] ?>" method="post">
  	      			<label for="name" class="text"> Nume:</label>
	  	      			<? if (!empty($errors['name'])) { ?>
	           			<span class="error"> * <?= $errors['name'] ?></span>
	  	      			<? } ?>
						<input id="name" name="name" placeholder="nume" type="text">
					<label for="surname" class="text">Prenume:</label>
           				<? if (!empty($errors['surname'])) { ?>
	           			<span class="error"> * <?= $errors['surname'] ?></span>
	  	      			<? } ?>
						<input id="surname" name="surname" placeholder="prenume" type="text"> 
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
	  	      	    
	  	      	    <label for="confirm_password" class="text">Confirma parola: </label>
						<? if (!empty($errors['confirm_password'])) { ?>
						<span class="error"> * <?= $errors['confirm_password'] ?></span>
						<? } ?>
						<input id="confirm_password" name="confirm_password" placeholder="password" type="password"> 
					    
					    <input name="submit" type="submit" value=" Sign Up ">
                		<input type="button" name="log"  onclick="window.location ='login.php';" value= "Login">
  	      		</form>
        	</div>
        </div>

    </body>
</html>