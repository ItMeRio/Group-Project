<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    // If admin is not logged in, redirect to admin login
    header("Location: admin-login.php");
    exit();
}

// You should include database connection logic here

// Fetch orders from the database (replace this with your database query)
$orders = []; // Fetch orders from the database

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <ul>
      <li><a href="edit-order.php">Edit Orders</a></li>
    </ul>
</head>
<body>
    <h2>Manage Orders</h2>

    <!-- Display order list -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['product_name']; ?></td>
                    <td><?php echo $order['quantity']; ?></td>
                    <td><?php echo $order['status']; ?></td>
                    <td>
                        <a href="edit-order.php?id=<?php echo $order['id']; ?>">Edit</a>
                        <a href="delete-order.php?id=<?php echo $order['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
