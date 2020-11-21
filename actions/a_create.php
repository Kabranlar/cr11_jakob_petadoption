<?php
	require_once 'db_connect.php';

	if ($_POST) {
		$name = $_POST["name"];
		$age = $_POST["age"];
		$species = $_POST["species"];
		$breed = $_POST["breed"];
		$size = $_POST["size"];
		$description = $_POST["description"];
		$image = $_POST["image"];
		$location = $_POST["location"];
		$hobbies = $_POST["hobbies"];

		$name = mysqli_real_escape_string($conn, $name);
        $age = mysqli_real_escape_string($conn, $age);
        $species = mysqli_real_escape_string($conn, $species);
        $breed = mysqli_real_escape_string($conn, $breed);
        $size = mysqli_real_escape_string($conn, $size);
        $description = mysqli_real_escape_string($conn, $description);
        $image = mysqli_real_escape_string($conn, $image);
        $location = mysqli_real_escape_string($conn, $location);
        $hobbies = mysqli_real_escape_string($conn, $hobbies);

		$sql = "INSERT INTO animals(name, age, species, breed, size, description, image, location, hobbies) VALUES ('$name', '$age', '$species', '$breed', '$size', '$description', '$image', '$location', '$hobbies')";

		if(mysqli_query($conn, $sql)) {
			echo "success <br><a href='../index.php'>Back to the home page</a>";
		} else {
			echo "error blabla".$conn->error;
		}
	}
?>