<?php 
	session_start();
	if(isset($_SESSION['user']) && $_SESSION['user'] != NULL) {
		session_destroy();
		header("location:index.php");
	}
	header("location:index.php");
?>
