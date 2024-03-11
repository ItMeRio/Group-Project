<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    // If admin is not logged in, redirect to admin login
    header("Location: admin-login.php");
    exit();
}

// You should include database connection logic here
$conn = new mysqli("hostname", "username", "password", "database");

$products = []; // Fetch products from the database

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <ul>
      <li><a href="add-product.php">Add Products</a></li>
      <li><a href="delete-product.php">Delete Products</a></li>
      <li><a href="edit-product.php">Edit Products</a></li>
    </ul>
</head>
<body>
    <h2>Manage Products</h2>

    <!-- Product list -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['description']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['stock_quantity']; ?></td>
                    <td>
                        <a href="edit-product.php?id=<?php echo $product['id']; ?>">Edit</a>
                        <a href="delete-product.php?id=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    
    <a href="add-product.php">Add New Product</a>
</body>
</html>
