<?php
$review = $_POST['review'];
$rating = $_POST['rating'];
$date = $_POST['date'];

$servername = "127.0.0.1:3308";
$username = "root";
$password = "";
$db = "teamproject";

//Database connection
$conn = mysqli_connect($servername, $username, $password,$db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " .$conn->connect_error);
}else{
    $stmt = $conn->prepare("insert into reviews(review_text, rating, review_date)
        values(?, ?, ?)");
    $stmt->bind_param("sii",$review, $rating, $date);
    $stmt->execute();
    echo "review submitted";
    $stmt->close();
    $conn->close();
}