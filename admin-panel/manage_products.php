<?php
// Connect to the database
include 'connection.php';

// Fetch all products
try {
    $stmt = $conn->prepare("SELECT * FROM products");
    $stmt->execute();
    $products = $stmt->fetchAll();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products</title>
    <!-- CSS styles will be added here -->
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
        margin-top: 20px;
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
    }
    a:hover {
        text-decoration: underline;
    }
    </style>

</head>
<body>
    <div class="container">
        <h1>Product Management</h1>
        <a href="add_product.php">Add/Delete New Product</a><br><br>
        <a href="edit_product.php">Edit Product</a>


        <table>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <!-- Additional columns as needed -->
                <th>Actions</th>
            </tr>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                <td><?php echo htmlspecialchars($product['price']); ?></td>
                <!-- Additional product details -->
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>


