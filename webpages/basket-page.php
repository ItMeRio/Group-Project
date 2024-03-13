<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once("includes/include.php") ?>
  <style>
    .container {
      display: flex;
      align-items: flex-start; /* Align items at the start of the container */
    }

    .basket-left {
      flex: 1;
      padding-right: 20px;
    }

    .basket-right {
      flex: 1;
      padding-left: 20px;
    }

    .product-box {
      border: 1px solid #ccc; /* Adding border around the product box */
      padding: 10px; /* Adding padding inside the product box */
      margin-bottom: 20px; /* Adjusting margin to separate product boxes */
    }

    .product {
      margin-bottom: 20px;
      display: flex;
      align-items: center;
    }

    .product img {
      width: 100px;
      margin-right: 20px;
    }

    .product label {
      font-weight: bold;
    }

    .product input[type="number"],
    .product input[type="text"] {
      width: 50px; /* Adjust input width */
      padding: 5px;
      margin-left: 10px;
    }

    .total-price-input {
      width: 80px; /* Adjust input width */
    }

    .btn {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
    }

    .btn:hover {
      background-color: #0056b3;
    }

    .address-box,
    .promo-code-box,
    .contact-box,
    .shipping-button,
    .total-amount-box {
      margin-top: 20px;
    }

    .address-box label,
    .promo-code-box label,
    .contact-box label,
    .total-amount-box label {
      font-weight: bold;
      display: block;
      margin-bottom: 5px;
    }

    .address-box input[type="text"],
    .address-box input[type="number"],
    .promo-code-box input[type="text"],
    .contact-box input[type="email"],
    .total-amount-box input[type="text"] {
      width: calc(100% - 20px); /* Adjusted width to account for padding */
      padding: 5px;
      margin-bottom: 10px;
    }

    .promo-code-box button,
    .shipping-button button {
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
    }

    .promo-code-box button:hover,
    .shipping-button button:hover {
      background-color: #0056b3;
    }

    .pay-with {
      margin-top: 20px;
    }

    .pay-with h2 {
      font-weight: bold;
    }

    .payment-icons img {
      width: 50px;
      margin-right: 10px;
    }

    .payment-icons img:last-child {
      margin-right: 0;
    }
  </style>
</head>
<body>
  <?php include_once("includes/navbar.php") ?>
  <main>
    <div class="container">
      <div class="basket-left">
        <div class="product-box"> <!-- Adding box around the products -->
          <h2>Women's Shoes</h2>
          <div class="product">
            <img src="womens_shoes.jpg" alt="Women's Shoes">
            <label for="womens_shoes">Quantity:</label>
            <input type="number" id="womens_shoes" name="womens_shoes" min="0" value="0">
            <input class="total-price-input" type="text" id="womens_shoes_price" name="womens_shoes_price" placeholder="Price">
            <button class="btn">Add to Cart</button>
          </div>
        </div>
        <div class="product-box"> <!-- Adding box around the products -->
          <h2>Men's Shoes</h2>
          <div class="product">
            <img src="mens_shoes.jpg" alt="Men's Shoes">
            <label for="mens_shoes">Quantity:</label>
            <input type="number" id="mens_shoes" name="mens_shoes" min="0" value="0">
            <input class="total-price-input" type="text" id="mens_shoes_price" name="mens_shoes_price" placeholder="Price">
            <button class="btn">Add to Cart</button>
          </div>
        </div>
      </div>
      <div class="basket-right">
        <div class="pay-with">
          <h2>Pay With</h2>
          <div class="payment-icons">
            <img src="paypal_icon.png" alt="PayPal">
            <img src="mastercard_icon.png" alt="Mastercard">
            <img src="visa_icon.png" alt="Visa">
          </div>
        </div>
        <div class="address-box">
          <h2>Address Information</h2>
          <label for="street_line">Street Line:</label>
          <input type="text" id="street_line" name="street_line" placeholder="Enter street address">
          <label for="postcode">Postcode:</label>
          <input type="text" id="postcode" name="postcode" placeholder="Enter postcode">
          <label for="city">City:</label>
          <input type="text" id="city" name="city" placeholder="Enter city">
        </div>
        <div class="contact-box">
          <h2>Contact Information</h2>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" placeholder="Enter your email address">
        </div
