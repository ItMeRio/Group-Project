<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once("includes/include.php") ?>
  <link rel="stylesheet" href="../css/baskets.css">

</head>

<body>
  <?php include_once("includes/navbar.php") ?>

  <main>
    <div class="main-content">

      <h1>Shopping basket</h1>

      <div class="product">Product 1 + Details
        <div class="quantity">
          <label for="quantity1">Quantity:</label>
          <input type="number" id="quantity1" name="quantity1" min="1" max="10">
        </div>
        <div class="remove">
          <button type="button">Remove from basket</button>
        </div>
      </div>

      <div class="product">Product 2 + Details
        <div class="quantity">
          <label for="quantity2">Quantity:</label>
          <input type="number" id="quantity2" name="quantity2" min="1" max="10">
        </div>
        <div class="remove">
          <button type="button">Remove from basket</button>
        </div>
      </div>

      <div class="product">Product 3 + Details
        <div class="quantity">
          <label for="quantity3">Quantity:</label>
          <input type="number" id="quantity3" name="quantity3" min="1" max="10">
        </div>
        <div class="remove">
          <button type="button">Remove from basket</button>
        </div>
      </div>

      <div class="subtotal">
        Subtotal (number of items)
        <a href="checkout-page.php" class="checkout-button">Proceed to checkout</a>
        <button onclick="window.location.href='previous-order-page.php'" class="previous-order-button">View Previous
          Orders</button>
      </div>

    </div>
  </main>
  <?php include_once("includes/footer.php") ?>

</body>

</html>