<?php
	require_once 'actions/db_connect.php';
   // get animal to be deleted
   if($_GET['animal_id']) {
      $animal_id = $_GET['animal_id'];

      $sql = "SELECT * FROM animals WHERE animal_id = {$animal_id}" ;
      $result = mysqli_query($conn, $sql);
      $row = $result->fetch_assoc();

      $conn->close();
   // get user to be deleted
   }elseif($_GET["userId"]) {
      $userId = $_GET["userId"];
      $sql = "SELECT * FROM users WHERE userId = $userId";
      $result = mysqli_query($conn, $sql);

      $row = $result->fetch_assoc();
      $conn->close();
   }
?>
<!DOCTYPE html>
<html>
<head>
   <title>Delete</title>
</head>
<body>

<h3>Do you really want to delete this <?php echo ($_GET['animal_id'] ? 'animal' : 'user');?>?</h3>
<form action ="<?php echo ($_GET['animal_id'] ? 'actions/a_delete.php' : 'actions/a_delete_user.php');?>" method="post">

   <?php 
      if ($_GET['animal_id']) {
         echo "<input type='hidden' name='animal_id' value='" . $row['animal_id'] . "'/>";
      }elseif ($_GET['userId']) {
         echo "<input type='hidden' name='userId' value='" . $row['userId'] . "'/>";
      }
   ?>
   <button type="submit">Yes, delete it!</button >
   <a href="index.php"> <button type="button"> No, go back!</button ></a>
</form>

</body>
</html>


<?php 
   
?>
