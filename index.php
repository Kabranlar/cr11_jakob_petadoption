<?php
	ob_start();
	session_start();
	require_once 'actions/db_connect.php';

	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) && !isset($_SESSION['admin']) && !isset($_SESSION['superAdmin'])) {
 		header("Location: login.php");
	 	exit;
	}


	// select logged-in users details
	if (isset($_SESSION['user'])) {
		$res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
	}elseif (isset($_SESSION['admin'])) {
		$res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['admin']);
	}elseif (isset($_SESSION['superAdmin'])) {
		$res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['superAdmin']);
	}
	//holds current user details
	$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pet Adoption</title>
	<!-- bs.css -->
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<style type ="text/css">

   </style>
</head>

<body class="bg-secondary">
	<!-- nav element -->
	<nav class="navbar navbar-light bg-light mb-5">
  		<form class="form-inline">
  			<a class="navbar-brand" href="index.php">
    		Huggy Bear Adoption
	  		</a>
	  		<a class="nav-item nav-link" href="general.php">
	    		Younglings
	  		</a>
	  		<a class="nav-item nav-link" href="seniors.php">
	    		Seniors
	  		</a>
  		</form>
  		<form class="form-inline">
  			<span>Hi <?php echo $userRow['userName']; ?>! <a  href="logout.php?logout">Sign Out</a></span>
  		</form>
  		<?php if (isset($_SESSION['admin']) || isset($_SESSION['superAdmin'])) {
  			echo "<form class='form-inline'><a href='index_admin.php'>Go to admin page</a></form>";
  		} ?>
	</nav>

	<!-- holds pet cards -->
	<div class="container-fluid mb-4">
		<div class ="row d-flex justify-content-center">

	       	<?php
			   	// include to work with db connection
				include ("actions/db_connect.php");
		  		// holds sql query
				$sql = "SELECT * FROM animals";
				// result is saved
				$result = mysqli_query($conn, $sql);
				$conn->close();

				// if result is not empty
				if($result->num_rows > 0) {
					// display pet cards
	                while($row = $result->fetch_assoc()) {
	                echo "
	                <div class='card col-sm-8 col-md-5 col-xl-3 m-4'>
	                	<img class='card-img-top mt-4 mx-auto' src='" . $row['image'] . "' style='height: 300px; object-fit:contain' alt='Card image cap'>
	                	<div class='card-body'>
	                    	<h5 class='card-title'>" . $row['name'] . " (" . $row['species'] . ")</h5>
	                    	<p class='card-text'>" . $row['description'] . "</p>
	                	</div>
	                	<ul class='list-group list-group-flush'>
	                    	<li class='list-group-item'>Breed: " . $row['breed'] . "</li>
	                    	<li class='list-group-item'>Age: " . $row['age'] . " years </li>
	                    	<li class='list-group-item'>Size: " . $row['size'] . "</li>
	                	</ul>
	                	<div class='card-body bottom d-flex justify-content-center'>
		                    <a class='card-link' href='details.php?animal_id=" . $row['animal_id'] . "'><button class='btn btn-info' type='button'>Details</button></a>
	                	</div>
	                </div>";
	               	}
	           	} else  {
	           		echo  "No data";
	           	}
			?>
		</div>
</div>
</body>
</html>
<?php ob_end_flush(); ?>