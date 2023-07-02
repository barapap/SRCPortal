<?php
// the password is empty by default on local host
$conn = mysqli_connect("localhost","root","","webdevproject");
// Check the connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>