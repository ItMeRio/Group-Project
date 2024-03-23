<?php
include 'connection.php';

$error_message = '';
$success_message = '';
$order = null;

// Fetch order details for editing
if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];

    try {
        $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
        $stmt->execute([$orderId]);
        $order = $stmt->fetch();

        if (!$order) {
            header("Location: manage_orders.php");
            exit();
        }
    } catch(PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}

// Handle Update Order
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $status = $_POST['status'];
    // Additional fields...

    try {
        $update_stmt = $conn->prepare("UPDATE orders SET customer_id = ?, status = ? WHERE order_id = ?");
        $update_stmt->execute([$customer_id, $status, $orderId]);
        $success_message = 'Order updated successfully.';
        header("Location: manage_orders.php");
        exit();
    } catch(PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Order</title>
    <!-- Add CSS here -->
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
        <h1>Edit Order</h1>

        <!-- Display success/error messages -->
        <?php if ($error_message): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if ($success_message): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php endif; ?>

        <!-- Edit Order Form -->
        <?php if ($order): ?>
        <form method="post">
            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">

            <label for="customer_id">Customer ID:</label>
            <input type="number" id="customer_id" name="customer_id" required
                   value="<?php echo htmlspecialchars($order['customer_id']); ?>">

            <label for="status">Status:</label>
            <input type="text" id="status" name="status" required
                   value="<?php echo htmlspecialchars($order['status']); ?>">

            <!-- Additional form fields... -->

            <button type="submit">Update Order</button>
        </form>
        <?php endif; ?>
    </div>
</body>
</html>
