<?php
	ob_start();	//output buffering (start remembering that would be outputted, but don't do anything with it)
	session_start();
	if (isset($_SESSION['user'])!="") {	//if session is NULL or an empty string
		header("Location: login.php");	//redirects to login.php
	}
	include_once 'actions/db_connect.php';	//include vs require: require will not tolerate errors and break, include will generate warnings but keep running
	$error = false;
	if (isset($_POST['btn-signup'])) {
		// sanitize user input to prevent sql injection
		$name = trim($_POST['name']);	//trim strips whitespace (or other characters) from the beginning and end of a string
		$name = strip_tags($name); // strip_tags strips HTML and PHP tags from a string
		$name = htmlspecialchars($name);	// converts special chars to HTML entities
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);

		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);

		// basic name validation
		if (empty($name)) {	// empty accepts only strings that are not empty
/*			 	“”	“apple”	NULL	FALSE	0	undefined
		empty()	TRUE	FALSE	TRUE	TRUE	TRUE	TRUE
		is_null()FALSE	FALSE	TRUE	FALSE	FALSE	ERROR
		isset()	TRUE	TRUE	FALSE	TRUE	TRUE	FALSE*/
			$error = true;
			$nameError = "Please enter your full name.";
		}elseif (strlen($name) < 2) {
			$error = true;
			$nameError = "Name must have at least 2 characters.";
		}elseif (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$error = true;
			$nameError = "Name must contain first and last name, separated by a whitespace.";
		}

		// basic email validation
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {	// filter returns false if email not in correct format
			$error = true;
			$emailError = "Please enter valid email address." ;
		}else{
			// checks whether the email already exists in the db or not
			$query = "SELECT userEmail FROM users WHERE userEmail='$email'";
			$result = mysqli_query($conn, $query);
			$count = mysqli_num_rows($result);	// counts # of rows that query returns

			if ($count != 0) {
				$error = true;
				$emailError = "Email is already in use.";
			}
		}

		// password validation
		if (empty($pass)){
			$error = true;
			$passError = "Please enter a password.";
		} else if(strlen($pass) < 6) {
			$error = true;
			$passError = "Password must have at least 6 characters." ;
		}

		// password hashing for security
		$password = hash('sha256', $pass);

		if (!$error) {
			$query = "INSERT INTO users(userName, userEmail, userPass) VALUES('$name', '$email', '$password')";
			$res = mysqli_query($conn, $query);

			if ($res) {
				$errTyp = "success";
				$errMSG = "Successfully registered. You may login now.";
				unset($name);
				unset($email);
				unset($pass);
			}else{
				$errTyp = "danger";
				$errMSG = "Something went wrong, try again later...";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login & Registration System</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"  integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"  crossorigin="anonymous">
</head>
<body>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
		
		<h2>Sign up</h2>
		<hr>

		<?php
			if (isset($errMSG)) {
		?>		
				<div class="alert alert-<?php echo $errTyp ?>">
					<?php echo $errMSG; ?>
				</div>
			<?php
			}
			?>
		
		<input type="text" name="name" class="form-control" placeholder="Enter name" maxlength="50" value="<?php echo $name ?>" />
		<span class="text-danger"><?php echo $nameError; ?></span>

		<input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value ="<?php echo $email ?>"  />
   
       	<span  class="text-danger"> <?php echo $emailError; ?> </span>

       	<input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15"  />
           
       	<span class="text-danger"> <?php echo $passError; ?> </span>

       	<hr>

       	<button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>

       	<hr>

       	<a href="index.php">Sign in Here...</a>
	</form>
</body>
</html>
<?php ob_end_flush(); ?>