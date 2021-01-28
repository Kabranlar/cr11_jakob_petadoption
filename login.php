<?php
	ob_start();
	session_start();
	require_once 'actions/db_connect.php';
	// if user session is not empty redirect to index.php
	if (isset($_SESSION['user'])!="") {
		header("Location: index.php");
		exit;
	// if admin/superAdmin session is not empty redirect to admin index page
	}elseif (isset($_SESSION['admin'])!="" || isset($_SESSION['superAdmin'])!="") {
		header("Location: index_admin.php");
		exit;
	}

	$error = false;
	
	if (isset($_POST['btn-login'])) {
		// prevent sql injections | clear invalid inputs
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);

		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);

		// prevent sql injections | clear invalid inputs
		if(empty($email)){
			$error = true;
		  	$emailError = "Please enter your email address.";
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ){
		  $error = true;
		  $emailError = "Please enter valid email address.";
		}

		if (empty($pass)){
			$error = true;
		  	$passError = "Please enter your password." ;
		}

		// if !error continue to login
		if (!$error) {
			echo "no error";
			$password = hash('sha256', $pass);
			$res = mysqli_query($conn, "SELECT userId, userName, userPass, admin FROM users WHERE userEmail='$email'");
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
			$count = mysqli_num_rows($res);

			if ($count == 1 && $row['userPass']==$password) {
				if ($row['admin']==1) {
					$_SESSION['admin'] = $row['userId'];
					header("Location: index_admin.php");
				}elseif ($row['admin']==0) {
					$_SESSION['user'] = $row['userId'];
					header("Location: index.php");
				}elseif ($row['admin']==7) {
					$_SESSION['superAdmin'] = $row['userId'];
					header("Location: index_admin.php");
				}
			}else {
				$errMSG = "Incorrect Credentials." ;
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login & Registration System</title>

<link rel="stylesheet" href ="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"  crossorigin="anonymous">
</head>
<body>

   	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">

        <h2>Sign In</h2>
        <hr>
           
        <?php
  			if ( isset($errMSG) ) {
				echo  $errMSG; ?>
       	<?php
  			}
  		?>
           
        <input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>"  maxlength="40" />
       	
         	<span class="text-danger"><?php  echo $emailError; ?></span>
 		
        <input type="password" name="pass"  class="form-control" placeholder="Your Password" maxlength="15"  />
       
       	<span class="text-danger"><?php  echo $passError; ?></span>
        <hr>
        <button type="submit" name="btn-login">Sign In</button>
        <hr>
 
    	<a href="register.php">Sign Up Here</a>
     
   	</form>
</body>
</html>
<?php ob_end_flush();
 ?>