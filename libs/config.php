<?php
	$conn = mysqli_connect("localhost", "root", "root", "admin");
	function is_user() {
		if(isset($_SESSION['user']) && !is_null($_SESSION['user']) && $_SESSION['role'] == 0) {
			return true;
		} 
		return false;
	}

	function is_admin() {
		if(isset($_SESSION['user']) && !is_null($_SESSION['user']) && $_SESSION['role'] == 1) {
			return true;
		}
		return false;
	}

	function db_get_row($sql) {
		global $conn;
		$query = mysqli_query($conn, $sql);
		$row = array();
		if(mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
		}
		return $row;
	}

	function validate($check) {
		$parttern = "/^[A-Za-z0-9_\.]{1,32}$/"; //filter character, allow 1 to 32 char
		if (preg_match($parttern, $check))
			return true;
	    else return false;
	}

	function validate_name($check) {
		$parttern = "/[A-Za-z]{1,32}$/"; //filter character, allow 1 to 32 char
		if (preg_match($parttern, $check))
			return true;
	    else return false;
	}

	function validate_phone($check) {
		$parttern = "/^[0-9]{10}$/";
		if(preg_match($parttern, $check))
			return true;
		else return false;
	}
?>
