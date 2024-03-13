<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once("includes/include.php") ?>
  <style>
    body{
      width = 100%;
    }
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
        <img src = "womensclothing.jpg" width="100%" height="300px"/>
      </div>
      <div class="category-box">
        <img src = "mensclothing.jpg" width="100%" height="300px"/>
      </div>
      <div class="category-box">
        <img src = "kidsclothing.jpg" width="100%" height="300px"/>
      </div>
      <div class="category-box">
      <img src = "accessories.jpg" width="100%" height="300px"/>
      </div>
      <div class="category-box">
        <h2>Offers</h2>
        <img src = "offers.jpg" width="100%" height="300px"/>
      </div>
    </div>
  </main>
  <?php include_once("includes/footer.php") ?>
</body>
</html>
