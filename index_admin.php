<?php
	ob_start();
	session_start();
	require_once 'actions/db_connect.php';

	// if session is not set this will redirect to login page
	if( !isset($_SESSION['admin' ]) && !isset($_SESSION['superAdmin'])) {
 		header("Location: index.php");
	 	exit;
	}
	// select logged-in admin details
	if (isset($_SESSION['admin'])) {
		$res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['admin']);
	}elseif (isset($_SESSION['superAdmin'])) {
		$res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['superAdmin']);
	}
	$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Huggy Bear Adoption Admin</title>
	<!-- bs.css -->
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<style type ="text/css">

   </style>
</head>

<body class="bg-secondary">
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
  			<span>Hi <?php echo $userRow['userName' ]; ?>! <a  href="logout.php?logout">Sign Out</a></span>
  		</form>
  		<form class="form-inline">
	  		<a href="index.php">See user site</a>
  		</form>
	</nav>

	<div class="container-fluid mb-4">
		<!-- btn to add an animal -->
	   	<a href= "create.php"><button class="btn btn-success mb-4" type="button">Add Animal</button></a>
		<!-- holds animal cards -->
		<div class ="row d-flex justify-content-center">

	       	<?php
				include ("actions/db_connect.php");

				$sql = "SELECT * FROM animals";
				$result = mysqli_query($conn, $sql);
				$conn->close();

				if($result->num_rows > 0) {
					// print animal cards
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
		                    <a class='card-link' href='update.php?animal_id=" . $row['animal_id'] . "'><button class='btn btn-primary' type='button'>Edit</button></a>
		                    <a class='card-link' href='delete.php?animal_id=" . $row['animal_id'] . "'><button class='btn btn-danger' type='button'>Delete</button></a>
		                    <a class='card-link' href='details.php?animal_id=" . $row['animal_id'] . "'><button class='btn btn-info' type='button'>Details</button></a>
	                	</div>
	                </div>";
	               	}
	           	} else  {
	           		echo  "No data";
	           	}
			?>
		</div>
		<!-- if user is not superadmin do not display user section | else superAdmin can see users and edit/delete them -->
		<div <?php if (!isset($_SESSION['superAdmin'])) {
			echo "style='display:none;'";
		} ?>>
			<table class="table table-dark table-bordered" max-width="">
		       <thead>
		           <tr class="text-center">
		               <th>userId</th>
		               <th>userName</th>
		               <th>userEmail</th>
		               <th>admin</th>
		               <?php
			               	include ("actions/db_connect.php");
		                    $sql = "SELECT * FROM users";
		                    $result = mysqli_query($conn, $sql);
		                    if($result->num_rows > 0) {
		                        echo "<th>Edit</th>
		                    		<th>Delete</th>";
		                    } 
	                   ?>
		           </tr>
		       </thead>
		       <tbody>
					<?php
						include ("actions/db_connect.php");

						$sql = "SELECT * FROM users";
						$result = mysqli_query($conn, $sql);
						$conn->close();

						if($result->num_rows > 0) {
			                while($row = $result->fetch_assoc()) {
			                   	echo "<tr class='text-center'>
			                       	<td>".$row['userId']."</td>
			                       	<td>".$row['userName']."</td>
			                       	<td>".$row['userEmail']."</td>
			                       	<td>".$row['admin']."</td>
			                       	<td><a href='update.php?userId=".$row['userId']."'><button type='button'>Edit</button></a></td>
	                                <td><a href='delete.php?userId=".$row['userId']."'><button type='button'>Delete</button></a></td>
			                   		</tr>";
			               	}
			           	} else  {
		               		echo  "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
			           	}
					?>
	       		</tbody>
		   	</table>
	   	</div>
	</div>
	   	

</body>
</html>
<?php ob_end_flush(); ?>