<?php
session_start();

// Redirect if not an admin
if (!isset($_SESSION['account_type']) || $_SESSION['account_type'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Database Connection
require 'connection.php';

try {
    // Example query: Total number of orders
    $stmt = $conn->prepare("SELECT COUNT(*) FROM orders");
    $stmt->execute();
    $totalOrders = $stmt->fetchColumn();

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .header { background-color: #333; color: white; padding: 10px 20px; text-align: center; }
        .stats, .management { margin: 20px; padding: 20px; background-color: white; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .management a { display: inline-block; padding: 10px 15px; background-color: #007bff; color: white; text-decoration: none; margin: 10px 0; border-radius: 5px; }
        .management a:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Admin Dashboard</h1>
    </div>

    <div class="stats">
        <h2>Statistics</h2>
        <p>Total Orders: <?php echo $totalOrders; ?></p>
        <!-- Add more statistics here -->
    </div>

    <div class="management">
        <h2>Management</h2>
        <a href="manage_products.php">Manage Products</a>
        <a href="manage_orders.php">Manage Orders</a>
        <a href="manage_customers.php">Manage Customers</a>
        <a href="manage_admin.php">Manage Admins</a> <!-- Link to Manage Admins -->
        <a href="manage_reviews.php">Manage Reviews</a>
        <!-- Add more links as necessary -->
    </div>
</body>
</html>
