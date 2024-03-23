<?php
include 'connection.php';

$error_message = '';
$success_message = '';
$product = null;

// Fetch product details for editing
if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    try {
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->execute([$productId]);
        $product = $stmt->fetch();

        if (!$product) {
            header("Location: manage_products.php");
            exit();
        }
    } catch(PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}

// Handle Update Product
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $productName = $_POST['product_name'];
    $price = $_POST['price'];
    // Additional fields...

    try {
        $update_stmt = $conn->prepare("UPDATE products SET product_name = ?, price = ? /* , other fields */ WHERE product_id = ?");
        $update_stmt->execute([$productName, $price /* , other variables */, $productId]);
        $success_message = 'Product updated successfully.';
    } catch(PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
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
        <h1>Edit Product</h1>

        <!-- Display success/error messages -->
        <?php if ($error_message): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if ($success_message): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php endif; ?>

        <!-- Edit Product Form -->
        <?php if ($product): ?>
        <form method="post">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required
                   value="<?php echo htmlspecialchars($product['product_name']); ?>">

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required
                   value="<?php echo htmlspecialchars($product['price']); ?>">

            <!-- Additional form fields... -->

            <button type="submit" name="update">Update Product</button>
        </form>

        <div>
            <a href="delete_product.php?product_id=<?php echo $product['product_id']; ?>" 
               onclick="return confirm('Are you sure you want to delete this product?');">
               Delete Product
            </a>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
