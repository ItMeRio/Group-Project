<?php 
include "connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once("includes/include.php") ?>
</head>
<body>
  <?php include_once("includes/navbar.php") ?>
  <main>
    <h2>About Us</h2>

    <div id="mission-section">
      <h3>Mission Statement</h3>
      <p>We are committed to providing high-quality and fashionable shoes to our customers. Our mission is to make every step you take a stylish one. At Shoe Emporium, we believe that your footwear should not only be comfortable but also a statement of your unique style.</p>
    </div>

    <div id="review-section">
      <h2>Leave a Review</h2>
      <form id="review-form" action="submit_review.php" method="post">
        <label for="review">Your Review:</label><br>
        <textarea id="review" name="review" rows="4" cols="50"></textarea><br>
        <label for="rating">Rating:</label>
        <input type="number" id="rating" name="rating" min="1" max="5"><br>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date"><br>
        <input type="submit" value="Submit">
      </form>
    </div>
  </main>
  <?php include_once("includes/footer.php") ?>
</body>
</html>
