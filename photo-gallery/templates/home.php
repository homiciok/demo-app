<?php

?>
<!DOCTYPE  html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Register Form in PHP</title>
        <link rel="stylesheet" href="css/style.css">
        <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id = "main">
        	<div id ="login"> 
  	      		<h2 class="text">Register</h2>
  	      		<form action = "<?php $_SERVER['PHP_SELF'] ?>" method="post">
  	      			
  	      			<label for="name" class="text"> Name:</label>
	  	      			<? if (!empty($errors['name'])) { ?>
	           			<span class="error"> * <?= $errors['name'] ?></span>
	  	      			<? } ?>
									<input id="name" name="name" placeholder="name" type="text" value="<?= @$dataArr['name'] ?>">
								
								<label for="surname" class="text">Surname:</label>
           				<? if (!empty($errors['surname'])) { ?>
	           			<span class="error"> * <?= $errors['surname'] ?></span>
	  	      			<? } ?>
									<input id="surname" name="surname" placeholder="surname" type="text" value="<?= @$dataArr['surname'] ?>"> 
								
								<label for="email" class="text">Email: </label>
           				<? if (!empty($errors['email'])) { ?>
	           			<span class="error"> * <?= $errors['email'] ?></span>
	  	      			<? } ?>
									<input id="email" name="email" placeholder="email" type="text" value="<?= @$dataArr['email'] ?>">
								
								<label for="password" class="text">Password: </label>
           				<? if (!empty($errors['password'])) { ?>
	           			<span class="error"> * <?= $errors['password'] ?></span>
	  	      			<? } ?>
	  	      			<input id="password" name="password" placeholder="password" type="password">      
	  	      	    
	  	      	  <label for="confirm_password" class="text">Confirm password: </label>
									<? if (!empty($errors['confirm_password'])) { ?>
									<span class="error"> * <?= $errors['confirm_password'] ?></span>
									<? } ?>
									<input id="confirm_password" name="confirm_password" placeholder="password" type="password"> 
								    
							    <input name="submit" type="submit" value=" Register ">
              		<input type="button" name="log"  onclick="window.location ='templates/login.php';" value= "Login">
  	      		</form>
        	</div>
        </div>

    </body>
</html>