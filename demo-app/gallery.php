<?php

$obj = Connect::getInstance();
if($_SESSION['email']) {
  $display = array();
  $display = $obj->getImages();
 // var_dump($display);
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Gallery</title>
  <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="public/css/styleg.css">
</head>

<body>
  <span>Your gallery</span>
  <input type="button" name="upload"  onclick="window.location ='upload.php';" value= "Upload"> 
  <input type="button" name="logout"  onclick="window.location ='logout.php';" value= "Logout"> 
  <div class="photos">
    <ul id="photo-gallery">

      <?php for($i=0; $i<count($display); $i++) {
        echo '<li><a href= "http://localhost/demo-app-2/images/'.$display[$i].'">

        <img class="object-fit_fill" src="http://localhost/demo-app-2/images/'.$display[$i].'"></a></li>';
      }

      ?>
    </ul>
  </div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="public/js/index.js"></script>
</body>
</html>