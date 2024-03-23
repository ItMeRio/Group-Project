<?php
include 'connection.php';

$error_message = '';
$orders = [];

// Fetch all orders
try {
    $stmt = $conn->prepare("SELECT * FROM orders");
    $stmt->execute();
    $orders = $stmt->fetchAll();
} catch(PDOException $e) {
    $error_message = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        a {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Management</h1>

        <?php if ($error_message): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <table>
            <tr>
                <th>Order ID</th>
                <th>Customer ID</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                <td><?php echo htmlspecialchars($order['customer_id']); ?></td>
                <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                <td><?php echo htmlspecialchars($order['status']); ?></td>
                <td>
                    <a href="view_order.php?order_id=<?php echo $order['order_id']; ?>">View</a>
                    <a href="edit_order.php?order_id=<?php echo $order['order_id']; ?>">Edit</a>
                    <a href="delete_order.php?order_id=<?php echo $order['order_id']; ?>" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <div class="order-actions">
            <h2>Manage Selected Order:</h2>
            <form action="" method="get">
                <label for="selected_order_id">Select Order ID:</label>
                <select id="selected_order_id" name="order_id">
                    <?php foreach ($orders as $order): ?>
                        <option value="<?php echo $order['order_id']; ?>">
                            Order <?php echo $order['order_id']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div>
                    <button formaction="view_order.php" type="submit">View Order</button>
                    <button formaction="edit_order.php" type="submit">Edit Order</button>
                    <button formaction="delete_order.php" type="submit" onclick="return confirm('Are you sure?');">Delete Order</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

