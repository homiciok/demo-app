<?php


$obj = Connect::getInstance();
$user_id = $_SESSION['id'];
$img = isset($_FILES['userfile']) ? $_FILES['userfile'] : '';
if($_SESSION['email'] && $img != "") {
  $uploaded = $obj->uploadImages($img); 
}

/*

    if(!empty($img))
    {
      $uploaded = uploadImages(); 
    
    }

  function uploadImages(){
      $img = isset($_FILES['userfile']) ? $_FILES['userfile'] : '';
      $obj = Connect::getInstance();
      $img_desc = reorderArray($img);


        foreach($img_desc as $value)
        { 
            $newname = date('Y-m-d H:i:s_',time()).mt_rand().'.jpg';
            $moved = move_uploaded_file($value['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/demo-app-2/images/" . $newname); 
            $path = "demo-app-2/images/";
            $query = "INSERT INTO `images` (`name`, `path`, `user_id`) VALUES ('$newname', '$path', '".$_SESSION['id']."');";
            $result = $obj->mysqli->query($query);
        }


    if(isset($result)){
      header('Location: /demo-app-2/profile.php');
    }else{
      echo "Unssuccesful upload. Try again";
    } 
        
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
*/

?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload</title>
    <link rel="stylesheet" href="public/css/style.css">
    <meta charset="utf-8">
    <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
</head>
<body>
    <div id ="main">
      <div id="login">
        <h2 class="text">Upload your files</h2>
          
          <form enctype="multipart/form-data" method="post" action="<?=$_SERVER['PHP_SELF']?>">
            <br>
            <div class ="upload">
              <input name="userfile[]" type="file" multiple="multiple" />
            </div>
            <br>
            <input type="submit" value="Upload">
          </form>
         
      </div>
    </div>   

</body>
</html>