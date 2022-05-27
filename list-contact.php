<?php
	include 'libs/config.php';
	session_start();
	if(!is_admin()) header('location:account.php');

	$sql = "SELECT * FROM LienHe ORDER BY `time` DESC";
	$query = mysqli_query($conn, $sql);
	$i = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>List Account</title>
	<style>
		table {
		  font-family: arial, sans-serif;
		  border-collapse: collapse;
		  width: 80%;
		}

		td, th {
		  border: 1px solid #dddddd;
		  text-align: center;
		  padding: 8px;
		}
	</style>
</head>
<body>
	<div><a href="account-admin.php">Return Dashboard</a></div>
	<div><a href="create-account.php">Create Account</a></div> <br>

	<table>
		<tr>
			<th>ID</th>
			<th>Full name</th>
			<th>Phone Number</th>
			<th>Email</th>
			<th>Question</th>
			<th>Time</th>
			<th>Remove</th>
		</tr>
		<?php while($row = mysqli_fetch_array($query)) { ?>
		<tr>
			<td><?php echo $i; $i++;?></td>
			<td><?php echo $row['ten'];?></td>
			<td><?php echo $row['sdt'];?></td>
			<td><?php echo $row['email'];?></td>
			<td><?php echo $row['text'];?></td>
			<td><?php echo $row['time'];?></td>
			<td><form action="" method="POST" onsubmit="return confirm('Are you sure?');">
				<button class="remove" type="submit" name="remove" value=<?php echo $row['id']?> >Remove</button>
			</form></td>
		</tr>
		<?php } ?>
		
	</table>
</body>
</html>

<?php
	if(isset($_POST['remove'])) {
		$id = $_POST['remove'];
		$sql = "DELETE FROM `LienHe` WHERE id='$id'";
		$query = mysqli_query($conn, $sql);
		header("refresh: 0");
	}
?> 

