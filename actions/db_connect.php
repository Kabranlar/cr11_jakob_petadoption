<?php 
	error_reporting(E_ERROR | E_PARSE);
	$hostName = "localhost";
	$userName = "root";
	$password = "";
	$dbName = "petadoption";

	$conn = mysqli_connect($hostName, $userName, $password, $dbName);

	if (!$conn) {
		echo "error";
	}
?>