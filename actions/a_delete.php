<?php
require_once 'db_connect.php';
if ($_POST) {
  $animal_id = $_POST['animal_id'];

$sql = "DELETE FROM animals WHERE animal_id={$animal_id}";
  if(mysqli_query($conn, $sql)){
    echo "success <br> <a href='../index.php'> Back to Homepage</a>";
  }else {
    echo "error";
  }$conn->close();
}
?>