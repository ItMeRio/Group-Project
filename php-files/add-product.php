<?php
// Include your database connection code here
$conn = new mysqli("hostname", "username", "password", "database");

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve product information from the form
    $productName = isset($_POST['product_name']) ? htmlspecialchars(trim($_POST['product_name'])) : '';
    $productDescription = isset($_POST['product_description']) ? htmlspecialchars(trim($_POST['product_description'])) : '';
    $productPrice = isset($_POST['product_price']) ? floatval($_POST['product_price']) : 0.0;
    $productStock = isset($_POST['product_stock']) ? intval($_POST['product_stock']) : 0;

    // Validate and sanitize the input (implement your validation logic here)

    // Insert the product into the products table
    $insertProductSQL = "INSERT INTO products (name, description, price, stock) 
                         VALUES ('$productName', '$productDescription', $productPrice, $productStock)";

    if ($conn->query($insertProductSQL) === TRUE) {
        echo "Product added successfully!";
    } else {
        echo "Error adding product: " . $conn->error;
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
    <title>Add Product</title>
</head>
<body>
    <h2>Add Product</h2>

    <form method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>

        <label for="product_description">Product Description:</label>
        <textarea id="product_description" name="product_description" required></textarea>

        <label for="product_price">Product Price:</label>
        <input type="number" id="product_price" name="product_price" step="0.01" required>

        <label for="product_stock">Product Stock:</label>
        <input type="number" id="product_stock" name="product_stock" required>

        <button type="submit">Add Product</button>
    </form>
</body>
</html>
