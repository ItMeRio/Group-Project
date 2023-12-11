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


