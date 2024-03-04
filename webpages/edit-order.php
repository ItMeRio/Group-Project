<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    // If admin is not logged in, redirect to admin login
    header("Location: admin-login.php");
    exit();
}

// Include your database connection logic here
$conn = new mysqli("your_server", "your_username", "your_password", "your_database");

// Check for a successful database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success_message = $error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $order_id = $_POST['order_id']; // Replace with the actual name of your order ID field

    // Fetch order details from the database (replace this with your actual query)
    $sql = "SELECT * FROM orders WHERE order_id = $order_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
    } else {
        $error_message = "Order not found.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
</head>
<body>
    <h2>Edit Order</h2>

    <?php if (isset($error_message)) : ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php else : ?>
        <form method="post">
            <!-- Display order details for editing -->
            <label for="order_id">Order ID:</label>
            <input type="text" id="order_id" name="order_id" value="<?php echo $order['order_id']; ?>" readonly>

            <!-- Add more fields for editing order details based on your database structure -->
            <!-- Example: <label for="new_status">New Status:</label>
                       <input type="text" id="new_status" name="new_status" value="<?php echo $order['status']; ?>"> -->

            <button type="submit">Save Changes</button>
        </form>
    <?php endif; ?>
</body>
</html>
