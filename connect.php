<?php
$servername = "localhost";
$username = "dimonu";
$password = "cI*EaRrIPlsMYnrN";
$db = "teamproject";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>