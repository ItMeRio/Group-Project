<?php 
include("connect.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

  <?php include_once("includes/include.php") ?>
  <style>
    

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
      background-color: white;
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

    th, td {
  padding: 20px;
  color: black;
}

.table_bottom{
  color: black;
}

.quantity_box{
  color:black;
  padding:15px;
}



  </style>
</head>
<body>
  <?php include_once("includes/navbar.php") ?>
  <main>
    <div class="container">
      <div class="basket-left">
       
          
          <div class="product">
            <h1 style= "color:black;">My Cart</h1>
            <table>
              <?php 
              $select_cart_products = mysqli_query($conn, "Select * from `cart`");
              $num = 1;
              if(mysqli_num_rows($select_cart_products)>0){
                echo "
                <thead>
                <tr>
                <th>SI No</th>
                <th> Name</th>
                <th> Image</th>
                <th> Price</th>
                <th> Quantity</th>
                <th>Total Price</th>
                <th>Action</th>
                </tr>
              </thead>
              <tbody>";
              
              while($fetch_cart_products = mysqli_fetch_assoc($select_cart_products)) {
                echo '<tr>';
                echo '<td>' . $num . '</td>'; // Assuming this is the serial number of the product
                echo '<td>' . $fetch_cart_products['name'] . '</td>'; // Assuming 'name' is the column name for product name
                echo '<td><img src="data:image/jpeg;base64,' . $fetch_cart_products['image'] . '"></td>'; // Displaying the image
                echo '<td>' . $fetch_cart_products['price'] . '</td>'; // Assuming 'price' is the column name for product price
                echo '<td>';
                echo '<form action = "" method = "post">';
                echo '<div class="quantity_box">';
                echo '<input type="number" class="update" min="1" value="' . $fetch_cart_products['quantity'] . '">';
                echo '<input type="submit" class="update_quantity" value="Update" style = "margin:10px;">';
                echo '</div>';
                echo '</form>';
                echo '</td>';
                echo '<td></td>'; 
                echo '<td>';
                echo '<a href="#"><i class="fa fa-trash"></i> Remove</a>';
                echo '</td>';
                echo '</tr>';
                $num++;
            }
            
            
              }else {
                echo "<div style='background-color: #333; padding: 10px; border: 1px solid #ddd; border-radius: 5px;'>";
                echo "<span style='color: white;'>No products!</span>";
                echo "</div>";
            }
              ?>
              
              
        
              </tbody>
            </table>
            <div class="table_bottom">
    <a href="products-page.php" class="bottom_btn" style="padding: 10px 20px; background-color: #333; color: white; text-align: center; text-decoration: none; border-radius: 5px; border: none; cursor: pointer;">Continue Shopping</a>
    <h3>Basket total: <span>242</span></h3>
</div>

          </div>
          <a href= "" class="delete_all_btn">
          <i class= "fa fa-trash"></i>Delete all
          </a>
        
        
         
        
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
