<?php
unset($_SESSION['email']);
unset($_SESSION['password']);
header("Location: /demo-app/login.php");
?>
