<?php 
	require_once 'db_connect.php';
	// get updated data for specific user
	if ($_POST) {
		$id = $_POST["id"];
		$name = $_POST["name"];
		$email = $_POST["email"];
		$admin = $_POST["admin"];
		// clean up
        $id = mysqli_real_escape_string($conn, $id);
		$name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $admin = mysqli_real_escape_string($conn, $admin);
		// update user in db
		$sql = "UPDATE `users` SET `userId` = '$id', `userName` = '$name', `userEmail` = '$email', `admin` = '$admin' WHERE userId = $id";

		if (mysqli_query($conn, $sql)) {
			echo "success <br> <a href='../index.php'>Back to home page</a>";
		}else {
			echo "error";
		}
	}
?>