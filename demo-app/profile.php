<?php
print_r($_SESSION);
if($_SESSION['email']) {
?>
Welcome <?php echo $_SESSION['email']; ?>. Click here to <a href="/demo-app/logout.php" tite="Logout"> Logout.
<?php
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Your profile</title>
</head>
<body>


</body>
</html>