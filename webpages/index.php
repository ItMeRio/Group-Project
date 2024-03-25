<?php
include('connect.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once("includes/include.php") ?>
  <style>
   .category-boxes {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
  margin-top: 20px;
}

.category-box {
  background-color: black;
  color: white;
  padding: 20px;
  border-radius: 8px;
  overflow: hidden;
  width: calc(33.33% - 40px); /* Adjust width for equal length */
  text-align: center;
}

.category-box img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.category-box h2 {
  margin-top: 0;
}

  </style>
</head>
<body>
  <?php include_once("includes/navbar.php") ?>
  <main>
    <h1>Categories:</h1>
    <div class="category-boxes">
      <div class="category-box">
        <a href="products-women.php">
          <img src="womensclothing.jpg" alt="Women's Clothing">
        </a>
      </div>
      <div class="category-box">
        <a href="products-men.php">
          <img src="mensclothing.jpg" alt="Men's Clothing">
        </a>
      </div>
      <div class="category-box">
        <a href="products-kids.php">
          <img src="kidsclothing.jpg" alt="Kids Clothing">
        </a>
      </div>
      <div class="category-box">
        <a href="products-accessories.php">
          <img src="accessories.jpg" alt="Accessories">
        </a>
      </div>
      <div class="category-box">
        <a href="products-offers.php">
          <img src="offers.jpg" alt="Offers">
        </a>
      </div>
    </div>
  </main>
  <?php include_once("includes/footer.php") ?>
</body>
</html>


