<?php
	include 'libs/config.php';
	session_start();
	if(!is_user()) header('location:index.php');
	echo "Hello: ".$_SESSION['user']." - ".(($_SESSION['role'] == 0) ? 'User' : 'Admin');
?>
<br>
<a href="account-info.php">Account Information</a>
<br>
<a href="logout.php">Logout</a>