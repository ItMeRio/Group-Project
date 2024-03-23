<?php
include 'connection.php';

$error_message = '';
$order_details = null;
$order_items = [];

// Check if order_id is provided
if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];

    // Fetch order details
    try {
        $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
        $stmt->execute([$orderId]);
        $order_details = $stmt->fetch();

        // Fetch order items
        $item_stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
        $item_stmt->execute([$orderId]);
        $order_items = $item_stmt->fetchAll();
    } catch(PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
} else {
    $error_message = "No Orders Available.";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Order</title>
    <style>
        /* CSS styles will be added here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #333;
        }
        .order-info, .order-items {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Order Details</h1>

        <?php if ($error_message): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php elseif ($order_details): ?>
            <div class="order-info">
                <h2>General Information</h2>
                <p><strong>Order ID:</strong> <?php echo htmlspecialchars($order_details['order_id']); ?></p>
                <p><strong>Customer ID:</strong> <?php echo htmlspecialchars($order_details['customer_id']); ?></p>
                <p><strong>Order Date:</strong> <?php echo htmlspecialchars($order_details['order_date']); ?></p>
                <p><strong>Status:</strong> <?php echo htmlspecialchars($order_details['status']); ?></p>
            </div>

            <div class="order-items">
                <h2>Order Items</h2>
                <table>
                    <tr>
                        <th>Item ID</th>
                        <th>Product ID</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Item Status</th>
                    </tr>
                    <?php foreach ($order_items as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['order_item_id']); ?></td>
                        <td><?php echo htmlspecialchars($item['product_id']); ?></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($item['price']); ?></td>
                        <td><?php echo htmlspecialchars($item['status']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php else: ?>
            <p>Order not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>