<?php
?>
<!DOCTYPE  html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="/photo-gallery/css/style.css">
  <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
</head>
<body>
  <div id = "main">
   <div id ="login"> 
     <h2 class="text">Login</h2>
     <form action = "<?php $_SERVER["PHP_SELF"];?>" method="post">
       <label for="email" class="text">Email: </label>
       <input id="email" name="email" placeholder="email" type="text">
       <label for="password" class="text">Parola: </label>
       <input id="password" name="password" placeholder="password" type="password">
       <input name="submit2" type="submit" value=" Login ">
     </form>
   </div>
 </div>
</body>
</html>
