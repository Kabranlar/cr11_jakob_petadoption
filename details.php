<!DOCTYPE html>
<html>
<head>
	<title>Details</title>
	<!-- bs.css -->
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<style type ="text/css">

   </style>
</head>

<body class="bg-secondary">
	<nav class="navbar navbar-light bg-light mb-5">
  		<a class="navbar-brand" href="index.php">
    	Huggy Bear Adoption
  		</a>
	</nav>

	<div class="container-fluid mb-4">

		<div class ="row d-flex justify-content-center">

	       	<?php
				include ("actions/db_connect.php");
				if ($_GET["animal_id"]) {
				    $animal_id = $_GET["animal_id"];
				    $sql = "SELECT * FROM animals WHERE animal_id = $animal_id";
				    $result = mysqli_query($conn, $sql);
				    $row = $result->fetch_assoc();
				}

			 	echo "
			 	<div class='card col-6 mt-5 mx-auto'>
	                <img class='card-img-top mt-4 mx-auto' src='" . $row['image'] . "' style='width: 200px; object-fit:contain' alt='Card image cap'>
	                <div class='card-body'>
	                    <h5 class='card-title'>" . $row['name'] . "</h5>
	                    <p class='card-text'>" . $row['description'] . "</p>
	                </div>
	                <ul class='list-group list-group-flush'>
	                    <li class='list-group-item'>Species: " . $row['species'] . "</li>
	                    <li class='list-group-item'>Breed: " . $row['breed'] . "</li>
	                    <li class='list-group-item'>Age: " . $row['age'] . "</li>
	                    <li class='list-group-item'>Size: " . $row['size'] . "</a></li>
	                    <li class='list-group-item'>Hobbies: " . $row['hobbies'] . "</li>
	                    <li class='list-group-item'>Location: " . $row['location'] . "</li>
	                </ul>
	                <div class='card-body bottom d-flex justify-content-center'>
	                    <a class='card-link' href='index.php'><button class='btn btn-info' type='button'>Home</button></a>
	                </div>
                </div>";
			?>
		</div>
	</div>
</body>
</html>