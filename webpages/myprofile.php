<?php
include 'connect.php';
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user"]["users_id"];

// Fetch user details
$sql_user = "SELECT * FROM users WHERE users_id = $user_id";
$result_user = mysqli_query($conn, $sql_user);
$user = mysqli_fetch_assoc($result_user);

// Fetch previous orders for the user
$sql_orders = "SELECT * FROM orders WHERE users_id = $user_id ORDER BY order_date DESC";
$result_orders = mysqli_query($conn, $sql_orders);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("includes/include.php") ?>
    <style>
        
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
            padding-top: 20px;
            color: #333;
        }

        h3 {
            margin-top: 30px;
            color: #666;
        }

        .user-details {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .order {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .order h4 {
            margin-top: 0;
            color: #333;
        }

        .order p {
            margin: 5px 0;
            color: #666;
        }

        .order img {
            max-width: 80px;
            max-height: 80px;
            margin-right: 10px;
            border-radius: 5px;
        }

        ul {
            padding-left: 20px;
        }

        li {
            margin-bottom: 5px;
            color: #555;
        }

        p.no-orders {
            color: #777;
        }
    </style>
</head>

<body>
    <?php include_once("includes/navbar.php") ?>
    <main>
        <div class="container">
            <h2>User Profile</h2>
            <div class="user-details">
                <h3>User Details</h3>
                <p><strong>Name:</strong> <?php echo $user['fullName']; ?></p>
                <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
            </div>
            <h3>Previous Orders History</h3>
            <?php
if ($result_orders && mysqli_num_rows($result_orders) > 0) {
    // Loop through each order
    while ($order = mysqli_fetch_assoc($result_orders)) {
        // Extract order details
        $order_id = $order['order_id'];
        $order_date = $order['order_date'];
        $total_price = $order['total_price'];
        $status = $order['status'];

        // Display order details
        echo "<div class='order'>";
        echo "<h4>Order ID: $order_id</h4>";
        echo "<p>Order Date: $order_date</p>";
        echo "<p>Total Price: $total_price</p>";
        echo "<p>Status: $status</p>";

        // Fetch and display order details
        $sql_order_details = "SELECT od.quantity_ordered, p.product_name, p.img AS product_img, od.subtotal 
                              FROM order_details od
                              INNER JOIN products p ON od.products_id = p.products_ID
                              WHERE od.order_id = $order_id";
        $result_order_details = mysqli_query($conn, $sql_order_details);

        if ($result_order_details && mysqli_num_rows($result_order_details) > 0) {
            echo "<ul>";
            while ($detail = mysqli_fetch_assoc($result_order_details)) {
                $quantity_ordered = $detail['quantity_ordered'];
                $product_name = $detail['product_name'];
                $product_img = $detail['product_img']; // Product image
                $subtotal = $detail['subtotal'];

                // Display product image if available
                $img_tag = "";
                if ($product_img) {
                    $img_tag = "<img src='data:image/jpeg;base64," . base64_encode($product_img) . "' alt='$product_name'>";
                }

                echo "<li>$img_tag $quantity_ordered x $product_name (Subtotal: $subtotal)</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No order details found for this order.</p>";
        }

        echo "</div>"; // Close order div
    }
} else {
    echo "<p>No previous orders found.</p>";
}
?>

        </div>
    </main>

</body>

</html>
