<?php
unset($_SESSION['email']);
unset($_SESSION['password']);
unset($_SESSION['user']);
header("Location: /demo-app-2/login.php");
?>
