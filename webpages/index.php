<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once("includes/include.php") ?>
  <style>
    .category-box {
      background-color: black;
      color: white;
      padding: 20px;
      margin: 10px;
      border-radius: 5px;
    }

    .category-box h2 {
      margin-top: 0;
    }
  </style>
</head>
<body>
  <?php include_once("includes/navbar.php") ?>
  <main>
    <div class="category-boxes">
      <div class="category-box">
        <a href="products-women.php">
        <img src = "womensclothing.jpg" width="100%" height="300px"/>
  </a>
      </div>
      <div class="category-box">
      <a href="products-men.php">
        <img src = "mensclothing.jpg" width="100%" height="300px"/>
  </a>
      </div>
      <div class="category-box">
      <a href="products-kids.php">
        <img src = "kidsclothing.jpg" width="100%" height="300px"/>
  </a>
      </div>
      <div class="category-box">
      <a href="products-accessories.php">
      <img src = "accessories.jpg" width="100%" height="300px"/>
  </a>
      </div>
      <div class="category-box">
        <h2>Offers</h2>
      <a href="products-offers.php">
        <img src = "offers.jpg" width="100%" height="300px"/>
  </a>
      </div>
    </div>
  </main>


  <?php include_once("includes/footer.php") ?>
</body>
</html>
