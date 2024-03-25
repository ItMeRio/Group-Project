<?php
session_start();
include("connect.php");

// Handle product quantity updates
if(isset($_POST['update_product_quantity'])){
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = $update_value WHERE id = $update_id");
    if($update_quantity_query){
        $display_message = "Cart updated successfully";
        // No need to redirect here since it's an AJAX request
    }
}

// Handle item removal
if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = $remove_id");
    header('location:basket-page.php');
}

// Handle deleting all items from the cart
if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart`");
    header('location:basket-page.php');
}

// Handle order processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $street_line = isset($_POST['street_line']) ? $_POST['street_line'] : '';
    $postcode = isset($_POST['postcode']) ? $_POST['postcode'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
    $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
    $card_number = isset($_POST['card_number']) ? $_POST['card_number'] : '';

    // Get the user ID from the session
    $users_id = isset($_SESSION['users_id']) ? $_SESSION['users_id'] : 0;

    // Calculate total price
    $total_price = 0;
    $select_cart_products = mysqli_query($conn, "SELECT * FROM `cart`");
    while($fetch_cart_products = mysqli_fetch_assoc($select_cart_products)) {
        $quantity_ordered = $fetch_cart_products['quantity'];
        $subtotal = $fetch_cart_products['price'] * $quantity_ordered;
        $total_price += $subtotal;
    }
    $users_id = isset($_SESSION['user']['users_id']) ? $_SESSION['user']['users_id'] : 0;
    // Insert data into the "orders" table
    $insert_order_query = "INSERT INTO orders (users_id, total_price, shipping_address, shipping_postcode, shipping_city, shipping_phone_number)
                         VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insert_order_query);
    mysqli_stmt_bind_param($stmt, "idsssi", $users_id, $total_price, $street_line, $postcode, $city, $phone_number);
    mysqli_stmt_execute($stmt);

    // Retrieve the order ID of the newly inserted order
    $order_id = mysqli_insert_id($conn);

    // Insert data into the "payment_transactions" table
    $insert_payment_query = "INSERT INTO payment_transactions (order_id, payment_method, payment_card_number, payment_amount)
                           VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insert_payment_query);
    mysqli_stmt_bind_param($stmt, "issd", $order_id, $payment_method, $card_number, $total_price);
    mysqli_stmt_execute($stmt);

    // Insert data into the "order_details" table for each product in the cart
    $select_cart_products = mysqli_query($conn, "SELECT * FROM `cart`");
while ($fetch_cart_products = mysqli_fetch_assoc($select_cart_products)) {
    $products_id = $fetch_cart_products['products_ID']; // Fetch the product ID from the cart
    $quantity_ordered = $fetch_cart_products['quantity'];
    $subtotal = $fetch_cart_products['price'] * $quantity_ordered;

    $insert_order_details_query = "INSERT INTO order_details (order_id, products_id, quantity_ordered, subtotal)
                                   VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insert_order_details_query);

    // Bind parameters dynamically
    mysqli_stmt_bind_param($stmt, "iiid", $order_id, $products_id, $quantity_ordered, $subtotal);

    // Execute the statement
    mysqli_stmt_execute($stmt);
}


    // Redirect to a success page or display a success message
    // header('location:success-page.php');
}
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
    .contact-box
    .payment-box,
    .shipping-button {
      margin-top: 20px;
    }

    .address-box label,
    .promo-code-box label,
    .contact-box label
    .payment-box label
    .card_number label {
      font-weight: bold;
      display: block;
      margin-bottom: 5px;
    }

    .address-box input[type="text"],
    .address-box input[type="number"],
    .promo-code-box input[type="text"],
    .contact-box input[type="text"],
    .payment-box input[type="text"]{
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

.table_bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.continue-shopping {
    /* Set flex-grow to 1 to allow the button to take up available space */
    flex-grow: 1;
    /* Adjust text-align to align the button's text to the left */
    text-align: left;
}

.basket-total {
    /* Adjust text-align to align the basket total text to the right */
    text-align: right;
}

.bottom_btn {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    /* Remove display: inline-block; */
}

.bottom_btn:hover {
    background-color: #0056b3;
}


/* Style for the table header */
thead {
    background-color: #007bff; /* Header background color */
    color: white; /* Header text color */
}

/* Style for table rows */
tbody tr:nth-child(even) {
    background-color: #f2f2f2; /* Alternate row background color */
}

/* Style for table cells */
th, td {
    padding: 15px; /* Adjust cell padding */
}

/* Hover effect for table rows */
tbody tr:hover {
    background-color: #cce5ff; /* Hover background color */
}


/* Style for the bottom of the table */
.table_bottom {
    background-color: #f8f9fa; /* Background color */
    border-top: 2px solid #ccc; /* Top border */
    padding: 20px; /* Padding */
}

.empty-cart-message {
    background-color: #f2f2f2;
    border: 2px solid #e6e6e6;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    margin-bottom: 20px;
}

.empty-cart-message h2 {
    color: #333;
    font-size: 24px;
    margin-bottom: 10px;
}

.empty-cart-message p {
    color: #555;
    font-size: 16px;
    margin-bottom: 20px;
}

.explore-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.explore-btn:hover {
    background-color: #0056b3;
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
            <?php if(isset($display_message)): ?>
              <div class="display_message success">
                <span><?php echo $display_message; ?></span>
                <i class="fas fa-times" onClick="this.parentElement.style.display='none';"></i>
              </div>
            <?php endif; ?>
            <table>
              <?php 
              $select_cart_products = mysqli_query($conn, "Select * from `cart`");
              $num = 1;
              $grand_total =0;
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
                echo '<td>£' . $fetch_cart_products['price'] . '</td>'; // Assuming 'price' is the column name for product price
                echo '<td>';
                echo '<form action = "" method = "post">';
                echo '<input type="hidden" name="update_quantity_id" value="' . $fetch_cart_products['id'] . '">';
                echo '<div class="quantity_box">';
                echo '<input type="number" name="update_quantity" class="update" min="1" value="' . $fetch_cart_products['quantity'] . '">';
                echo '<input type="submit" name="update_product_quantity" class="update_quantity" value="Update" style = "margin:10px;">';
                echo '</div>';
                echo '</form>';
                echo '</td>';
                echo '<td>£' . $subtotal =($fetch_cart_products['price'])*($fetch_cart_products['quantity']) . '</td>';; 
                echo '<td>';
                echo '<a href="basket-page.php?remove=' . $fetch_cart_products['id'] . '" onclick="return confirm(\'Are you sure you want to remove this item?\')"><i class="fa fa-trash"></i> Remove</a>';
                echo '</td>';
                echo '</tr>';
                $grand_total = $grand_total+($fetch_cart_products['price'])*($fetch_cart_products['quantity']);
                $num++;
            }
            
            
              }else {
                echo "<div class='empty-cart-message'>";
                echo "<h2>Your Cart is Empty</h2>";
                echo "<p>Looks like you haven't added any items to your cart yet.</p>";
                echo "<p>Explore our products and find something you love!</p>";
                echo "<a href='products-page.php' class='explore-btn'>Explore Products</a>";
                echo "</div>";
            }
            ?>
              
              
        
              </tbody>
            </table>

            <?php 
            if($grand_total >0){
              echo "<div class='table_bottom'>
              <div class='continue-shopping'>
              <a href='products-page.php' class='bottom_btn' >Continue Shopping</a>
              </div>
              <div class='basket-total'>
              <h3>Basket total: <span>£" . $grand_total . "</span></h3>
              </div>
          </div>";
            
            ?>
            

          </div>
          <a href="basket-page.php?delete_all=true" class="delete_all_btn" onclick="return confirm('Are you sure you want to delete all items?');">
    <i class="fa fa-trash"></i>Delete all
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
      <h2>Shipping Information</h2>
      <form action="" method="post">
      <label for="street_line">Street Line:</label>
      <input type="text" id="street_line" name="street_line" placeholder="Enter street address">
      <label for="postcode">Postcode:</label>
      <input type="text" id="postcode" name="postcode" placeholder="Enter postcode">
      <label for="city">City:</label>
      <input type="text" id="city" name="city" placeholder="Enter city">
    </div>
    <div class="contact-box">
      <h2>Contact Information</h2>
      <label for="phone_number">Phone Number:</label>
      <input type="text" id="phone_number" name="phone_number" placeholder="Enter your phone number">
    </div>

    <div class="payment-box">
      <h2>Payment Information</h2>
      <label for="payment_method">Payment Method:</label>
      <input type="text" id="payment_method" name="payment_method" placeholder="Enter payment method">
      <label for="card_number">Card Number:</label>
      <input type="text" id="card_number" name="card_number" placeholder="Enter Card Number">
    </div>

    <div class="shipping-button">
      <button class="btn" type="submit"><i class="fa fa-credit-card" aria-hidden="true"></i> Checkout</button>
    </div>
  </div>
</form>

       
      
    </div>
          <?php
            }else{
              echo"";
            }

            ?>
        
        
         
        
      
  </main>
  <?php include_once("includes/footer.php") ?>
</body>
</html>