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
        <h2>Women's Clothing</h2>
        <!-- Add content for women's clothing category -->
      </div>
      <div class="category-box">
        <h2>Men's Clothing</h2>
        <!-- Add content for men's clothing category -->
      </div>
      <div class="category-box">
        <h2>Kids' Clothing</h2>
        <!-- Add content for kids' clothing category -->
      </div>
      <div class="category-box">
        <h2>Accessories</h2>
        <!-- Add content for accessories category -->
      </div>
      <div class="category-box">
        <h2>Offers</h2>
        <!-- Add content for offers category -->
      </div>
    </div>
  </main>
  <?php include_once("includes/footer.php") ?>
</body>
</html>
