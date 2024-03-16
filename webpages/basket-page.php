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
      width: 100%;
      height: 80%;
      text-align: center;
    }

    .product img {
      width: 100px;
      margin-right: 20px;
      margin-bottom: 25%;
    }

    .product label {
      font-weight: bold;
     margin-top: 20px;
    }

    .product input[type="number"] {
      width: 20%;
      padding: 5px;
      
    }

    .product .price-input {
      width: 60px;
      padding: 5px;
      
    }

    .btn {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 30px;
    }

    .btn:hover {
      background-color: #0056b3;
    }

    .address-box,
    .promo-code-box,
    .contact-box,
    .shipping-button {
      margin-top: 20px;
    }

    .address-box label,
    .promo-code-box label,
    .contact-box label {
      font-weight: bold;
      display: block;
      margin-bottom: 5px;
    }

    .address-box input[type="text"],
    .address-box input[type="number"],
    .promo-code-box input[type="text"],
    .contact-box input[type="email"] {
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
       
          
          <div class="product">
            <img src="womens_shoes.jpg" >
            <label for="womens_shoes">Quantity:</label>
            <input type="number" id="womens_shoes" name="womens_shoes" min="0" value="0">
            <label for="womens_shoes_price">Price:</label>
            <h6> 50£ </h6> 
            <button class="btn">Add to Cart</button>
          </div>
        
        
         
        
      </div>
      <div class="basket-right">
        <div class="pay-with">
          <h2>Pay With</h2>
          <div class="payment-icons">
          
            <img src="mastercard.png" alt="mastercard">
            <img src="visa.png" alt="Visa">
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
        </div>
        <div class="promo-code-box">
          <h2>Apply Promo Code</h2>
          <input type="text" id="promo_code" name="promo_code" placeholder="Enter promo code">
          <button class="btn">Apply</button>
        </div>
        <div class="shipping-button">
          <button class="btn">Continue to Shipping</button>
        </div>
      </div>
    </div>
  </main>
  <?php include_once("includes/footer.php") ?>
</body>
</html>
