<?php
  ob_start();
  session_start();
	require_once 'actions/db_connect.php';

  // if session is not set this will redirect to login page
  if(!isset($_SESSION['admin' ]) && !isset($_SESSION['superAdmin' ])) {
    header("Location: index.php");
    exit;
  }

	if ($_GET["animal_id"]) {
		$animal_id = $_GET["animal_id"];
		$sql = "SELECT * FROM animals WHERE animal_id = $animal_id";
		$result = mysqli_query($conn, $sql);

		$row = $result->fetch_assoc();
	}elseif ($_GET["userId"]) {
    $userId = $_GET["userId"];
    $sql = "SELECT * FROM users WHERE userId = $userId";
    $result = mysqli_query($conn, $sql);

    $row = $result->fetch_assoc();
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit</title>
  <!-- bs.css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="bg-secondary">
  <nav class="navbar navbar-light bg-light mb-5">
    <a class="navbar-brand" href="index.php">
    Huggy Bear Adoption
    </a>
  </nav>
  <div class="container-fluid">

    <?php
      if ($_GET["animal_id"]) {
        echo "
          <form action='actions/a_update.php' method='post'>
            <input type='hidden' name='id' value='" . $row['animal_id'] . "'>
            <div class='form-row'>
              <div class='form-group col-md-6'>
                <label for='inputName'>Name</label>
                <input type='text' name='name' class='form-control' id='inputName' value='" . $row['name'] . "'>
              </div>
              <div class='form-group col-md-6'>
                <label for='inputAge'>Age</label>
                <input type='text' name='age' class='form-control' id='inputAge' value='" . $row['age'] . "'>
              </div>
            </div>
            <div class='form-row'>
              <div class='form-group col-md-4'>
                <label for='inputSpecies'>Species</label>
                <input type='text' name='species' class='form-control' id='inputSpecies' value='" . $row['species'] . "'>
              </div>
              <div class='form-group col-md-4'>
                <label for='inputBreed'>Breed</label>
                <input type='text' name='breed' class='form-control' id='inputBreed' value='" . $row['breed'] . "'>
              </div>
              <div class='form-group col-md-4'>
                <label for='inputSize'>Size</label>
                <input type='text' name='size' class='form-control' id='inputSize' value='" . $row['size'] . "'>
              </div>
            </div>
            <div class='form-group'>
              <label for='inputDescription'>Description</label>
                <textarea class='form-control' name='description' id='inputDescription' rows='3'>" . $row['description'] . "</textarea>
              </div>
            <div class='form-group'>
              <label for='inputImage'>Image URL</label>
              <input type='text' name='image' class='form-control' id='inputImage' value='" . $row['image'] . "'>
            </div>
            <div class='form-group'>
              <label for='inputLocation'>Location</label>
              <input type='text' name='location' class='form-control' id='inputLocation' value='" . $row['location'] . "'>
            </div>
            <div class='form-group'>
              <label for='inputHobbies'>Hobbies</label>
              <input type='text' name='hobbies' class='form-control' id='inputHobbies' value='" . $row['hobbies'] . "'>
            </div>
            <button type='submit' class='btn btn-primary'>Save Changes</button>
          </form>
        ";
      }elseif ($_GET["userId"]) {
        echo "
          <form action='actions/a_update_user.php' method='post'>
            <div class='form-row'>
              <div class='form-group col-md-6'>
                <label for='inputId'>Id</label>
                <input type='text' name='id' class='form-control' id='inputId' value='" . $row['userId'] . "'>
              </div>
              <div class='form-group col-md-6'>
                <label for='inputName'>Name</label>
                <input type='text' name='name' class='form-control' id='inputName' value='" . $row['userName'] . "'>
              </div>
            </div>
            <div class='form-row'>
              <div class='form-group col-md-6'>
                <label for='inputEmail'>Email</label>
                <input type='text' name='email' class='form-control' id='inputEmail' value='" . $row['userEmail'] . "'>
              </div>
              <div class='form-group col-md-6'>
                <label for='inputAdmin'>Admin</label>
                <input type='text' name='admin' class='form-control' id='inputAdmin' value='" . $row['admin'] . "'>
              </div>
            </div>
            <button type='submit' class='btn btn-primary'>Save Changes</button>
          </form>
        ";
      }
    ?>
  </div>
</body>
</html>
<?php ob_end_flush(); ?>