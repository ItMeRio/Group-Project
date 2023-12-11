<?php
// Include your database connection code here
$conn = new mysqli("hostname", "username", "password", "database");

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve customer information from the form
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $address = isset($_POST['address']) ? htmlspecialchars(trim($_POST['address'])) : '';
    $payment = isset($_POST['payment']) ? htmlspecialchars(trim($_POST['payment'])) : '';

    // Check if the basket is empty
    if (empty($_SESSION['basket'])) {
        echo "Your basket is empty. Add items before proceeding to checkout.";
    } else {
        // Process the order and insert order details into the database
        $insertOrderSQL = "INSERT INTO orders (customer_name, customer_address, payment_info, order_date) 
                           VALUES ('$name', '$address', '$payment', NOW())";

        if ($conn->query($insertOrderSQL) === TRUE) {
            $orderID = $conn->insert_id;

            // Insert individual items into the order_items table
            foreach ($_SESSION['basket'] as $item) {
                $productName = $item['productName'];
                $quantity = $item['quantity'];

                // Get product details from the products table
                $productSQL = "SELECT * FROM products WHERE name = '$productName'";
                $productResult = $conn->query($productSQL);

                if ($productResult->num_rows > 0) {
                    $product = $productResult->fetch_assoc();
                    $productID = $product['id'];

                    // Insert into order_items table
                    $insertOrderItemSQL = "INSERT INTO order_items (order_id, product_id, quantity) 
                                           VALUES ($orderID, $productID, $quantity)";

                    $conn->query($insertOrderItemSQL);

                    // Update stock levels in the products table
                    $updateStockSQL = "UPDATE products SET stock = stock - $quantity WHERE id = $productID";
                    $conn->query($updateStockSQL);
                }
            }

            // Clear the basket after the order is processed
            $_SESSION['basket'] = [];

            // Send email notification to the admin
            $admin_email = 'admin@example.com'; 
            $subject = 'New Order Notification';
            $message = "A new order has been placed. Customer: $name, Address: $address, Payment: $payment";
            $headers = 'From: webmaster@example.com' . "\r\n" .
                    'Reply-To: webmaster@example.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

            // Send the email notification to the admin
            mail($admin_email, $subject, $message, $headers);

            // Redirect to a confirmation page
            header("Location: confirmation-page.php");
            exit();
        } else {
            echo "Error processing the order: " . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="baskets.css" />
    <link rel="stylesheet" href="registration.css" />
</head>
<nav>
    <ul>
        <li><a href="home page.html">Home</a></li>
        <li><a href="product -page.html">Products</a></li>
        <li><a href="contact-page.html">Contact Us</a></li>
        <li><a href="about us page.html">About Us</a></li>
        <li><a href="registration.html">Registration</a></li>
        <li><a href="sign-in page.html">Sign in</a></li>
        <li><a href="basket-page.html">Basket</a></li>
    </ul>
</nav>

<body>
    <div class="main-content">
        <h1>Checkout</h1>

        <div class="checkout-form">
            <form action="" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required />

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required />

                <label for="country">Country:</label>
                <input type="text" id="country" name="country" required />

                <label for="city">City:</label>
                <input type="text" id="city" name="city" required />

                <label for="postcode">Postcode:</label>
                <input type="text" id="postcode" name="postcode" required />

                <label for="payment">Payment Information:</label>
                <input
                    type="text"
                    id="payment"
                    name="payment"
                    placeholder="Credit Card Number"
                    required
                />

                <div class="subtotal">
                    Subtotal:
                    <button type="submit">Confirm and Pay</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
