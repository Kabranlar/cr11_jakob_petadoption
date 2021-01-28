<?php
require_once 'db_connect.php';
if ($_POST) {
  $userId = $_POST['userId'];
// delete specific user from db
$sql = "DELETE FROM users WHERE userId={$userId}";
  if(mysqli_query($conn, $sql)){
    echo "success <br> <a href='../index.php'> Back to Homepage</a>";
  }else {
    echo "error";
  }$conn->close();
}
?>