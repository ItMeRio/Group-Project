<?php
// Include your database connection code here
$conn = new mysqli("hostname", "username", "password", "database");

session_start();

// Assume you have a method to get product details by ID
// Replace getProductDetailsById with your actual method
function getProductDetailsById($productId) {
    global $conn;

    // Escape the product ID to prevent SQL injection
    $productId = mysqli_real_escape_string($conn, $productId);

    // Query to retrieve product details by ID
    $sql = "SELECT * FROM products WHERE product_id = $productId";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result) {
        // Fetch the product details as an associative array
        $productDetails = $result->fetch_assoc();

        // Free the result set
        $result->free_result();

        return $productDetails;
    } else {
        // Handle query error (log, display an error message, etc.)
        echo "Error retrieving product details: " . $conn->error;
        return null;
    }
}

// Check if a product ID is provided in the URL
if (isset($_GET['id'])) {
    $productId = intval($_GET['id']);
    $productDetails = getProductDetailsById($productId);

    if (!$productDetails) {
        echo "Product not found!";
        // You might want to include a link to go back to the products list or do something else
        exit();
    }
} else {
    echo "Product ID not provided!";
    // You might want to include a link to go back to the products list or do something else
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve updated product information from the form
    $updatedProductName = isset($_POST['product_name']) ? htmlspecialchars(trim($_POST['product_name'])) : '';
    $updatedProductDescription = isset($_POST['product_description']) ? htmlspecialchars(trim($_POST['product_description'])) : '';
    $updatedPrice = isset($_POST['price']) ? floatval($_POST['price']) : 0.0;

    // Validate and sanitize the input (implement your validation logic here)

    // Update the product details in the database
    $updateProductSQL = "UPDATE products 
                         SET product_name = '$updatedProductName', 
                             product_description = '$updatedProductDescription',
                             price = $updatedPrice
                         WHERE id = $productId";

    if ($conn->query($updateProductSQL) === TRUE) {
        echo "Product details updated successfully!";
    } else {
        echo "Error updating product details: " . $conn->error;
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
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>

    <form method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" value="<?php echo $productDetails['product_name']; ?>" required>

        <label for="product_description">Product Description:</label>
        <textarea id="product_description" name="product_description" required><?php echo $productDetails['product_description']; ?></textarea>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" value="<?php echo $productDetails['price']; ?>" required>
        <!-- Add other input fields for additional product details -->

        <button type="submit">Update Product</button>
    </form>
</body>
</html>

