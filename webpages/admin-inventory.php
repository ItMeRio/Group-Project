<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    // If admin is not logged in, redirect to admin login
    header("Location: admin-login.php");
    exit();
}

// You should include database connection logic here
$conn = new mysqli("hostname", "username", "password", "database");

$inventory = []; // Fetch inventory from the database

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inventory Management</title>
<ul>
    <li><a href="add-inventory.php">Add Inventory</a></li>
    <li><a href="delete-inventory.php">Delete Inventory</a></li>
    <li><a href="edit-inventory.php">Edit Inventory</a></li>
</ul>
</head>
<body>
    <h2>Inventory Management</h2>

    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Stock Quantity</th>
                <th>Threshold</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inventory as $item) : ?>
                <tr>
                    <td><?php echo $item['id']; ?></td>
                    <td><?php echo $item['product_name']; ?></td>
                    <td><?php echo $item['stock_quantity']; ?></td>
                    <td><?php echo $item['threshold']; ?></td>
                    <td>
                        <a href="edit-inventory.php?id=<?php echo $item['id']; ?>">Edit</a>
                        <a href="delete-inventory.php?id=<?php echo $item['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    
    <a href="add-inventory.php">Add New Inventory Item</a>
</body>
</html>

